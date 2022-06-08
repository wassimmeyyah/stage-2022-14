<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Ville;

use App\Models\Porteur;
use Barryvdh\DomPDF\PDF;
use App\Models\Specialite;
use App\Models\Territoire;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PorteurController extends Controller
{
    public function  show(Request $request){

        if(isset($request->Recherche)) {
            $searchValue = $request->Recherche;
            $porteurs = \App\Models\porteur::where('PORTCode','LIKE', $searchValue . '%')->get();
            //return view("viewporteur", ["porteurs" => $porteurs]);
        }else {
            $porteurs = \App\Models\porteur::orderBy("PORTCode","asc")->paginate(10);
            //return view("porteur", ["porteurs" => $porteurs]);
        }

        return view("porteur", ["porteurs" => $porteurs]);}

    public function show2(Request $request){
        $porteurs = \App\Models\Porteur::orderBy("PORTCode","asc")->get();
        return view('ListeMailPorteur',["porteurs" => $porteurs]);
    }

    public function index()
    {
        $porteur = porteur::all();

        return view('index', compact('porteur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users') ) {
            return redirect()->route('goPorteur');
        }

        $etablissements = Etablissement::all();

        return view('porteurCreate', compact('etablissements'));
    }

    public function up(porteur $porteur)
    {
        return view('porteurUpdate', compact("porteur"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $res = DB::table('porteur')->insert([

            'PORTNom' => $request->input('PORTNom'),
            'PORTMail' => $request->input('PORTMail'),
            'PORTTel' => $request->input('PORTTel'),
            'ETABCode' => $request->input('ETABCode')
        ]);


        return redirect('/porteur')->with("successAjout", "le porteur' '$request->PORTNom'a été ajouté avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('updateDelete-users') ) {
            return redirect()->route('goPorteur');
        }

        $porteur = porteur::findOrFail($id);
        return view('porteurUpdate', compact("porteur"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, porteur $porteur)
    {


        $res = DB::table('porteur')->where('PORTCode', '=', $porteur->PORTCode)
            ->update([


                'PORTNom' => $request->input('PORTNom'),
                'PORTMail' => $request->input('PORTMail'),
                'PORTTel' => $request->input('PORTTel'),
                'ETABCode' => $request->input('ETABCode')
            ]);

        return redirect('/porteur')->with("successModify", "Le porteur' '$request->PORTNom' a été mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Porteur $porteur)
    {
        if(Gate::denies('updateDelete-users') ) {
            return redirect()->route('goPorteur');
        }
        try {
            $nomPORT = $porteur->PORTNom;
            $porteur->delete();

            return back()->with("successDelete", "Le porteur' '$nomPORT' a été supprimé avec succèss");
        } catch (QueryException $q) {
            return back()->with("successDelete", "Ce porteur ne peut être supprimé car il est le porteur d'une expérimentation");
        }
    }

    public function search(){
        $q = request()->input('q');
        $porteurs = Porteur::where('PORTCode','like',"%$q%")
            ->orWhere('PORTNom','like',"%$q%")
            ->orWhere('PORTMail','like',"%$q%")
            ->orWhere('PORTTel','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();

        return view('porteurSearch')->with('porteur', $porteurs);
    }

    public function recherche(){
        $q = request()->input('q');
        $porteurs = Porteur::where('PORTCode','like',"%$q%")
            ->orWhere('PORTNom','like',"%$q%")
            ->orWhere('PORTMail','like',"%$q%")
            ->orWhere('PORTTel','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();

        return view('porteurSearch')->with('porteur', $porteurs);
    }

    public function affiche($id2){




        $porteur = Porteur::find($id2);
        $etablissement = Etablissement::where('ETABCode', $porteur->ETABCode)->first();
        $territoire= Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();

        return view("porteurAffichage", compact( "porteur","etablissement","territoire","type","specialite","ville"));
    }


    public function telechargerPdf($id3){



        $porteur = Porteur::findOrFail($id3);
        $etablissement = Etablissement::where('ETABCode', $porteur->ETABCode)->first();
        $territoire= Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();

        $pdf = FacadePdf::loadView('telechargement2',compact('porteur','etablissement','territoire','type','specialite','ville'));
        return $pdf->download('Synthèse - Porteur.pdf');
    }

    // Nordine
}
