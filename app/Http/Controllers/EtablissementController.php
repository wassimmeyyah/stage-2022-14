<?php

namespace App\Http\Controllers;

use pdf;
use App\Models\Type;
use App\Models\Ville;
use App\Models\Coordonnee;
use App\Models\Specialite;
use App\Models\Territoire;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class EtablissementController extends Controller
{

    public function  show(Request $request){
        //$msg = "Hello";

        //$etablissement=Etablissement::where('ETABCode',' 0690076H ')->first();
        //ddd($etablissement->ETABCode);
        //ddd($etablissement->getKey());



        $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABCode","asc")->paginate(10);
            //return view("etablissement", ["etablissements" => $etablissements]);

        
        return view("etablissement", ["etablissements" => $etablissements]);
    }

    public function  show2(Request $request){

        $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABCode","asc")->get();
        $coordonnees= Coordonnee::all();


        return view("carte", ["etablissements" => $etablissements], compact('coordonnees'));
    }

    public function index()
    {

        $etablissement = Etablissement::where('ETABCode', '!=', 'Aucun')->get();

        return view('index', compact('etablissement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users') ) {
            return redirect()->route('goEtablissement');
        }

        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        return view('etablissementCreate', compact('territoires','types','specialites','villes'));
    }

    public function up(Etablissement $etablissement)
    {
        return view('etablissementUpdate', compact("etablissement"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        $res = DB::table('etablissement')->insert([
            'ETABCode' => $_POST['ETABCode'],
            'ETABNom' => $_POST['ETABNom'],
            'ETABMail' => $_POST['ETABMail'],
            'ETABChef' => $_POST['ETABChef'],
            'ETABAdresse' => $_POST['ETABAdresse'],
            'ETABTel' => $_POST['ETABTel'],
            'TERRCode' => $_POST['TERRCode'],
            'TYPCode' => $_POST['TYPCode'],
            'SPECode' => $_POST['SPECode'],
            'VILCode' => $_POST['VILCode']


        ]);


        return redirect('/etablissement')->with("successAjout", "l'etablissement' '$request->ETABNom'a été ajouté avec succès") or redirect('/etablissement/ajouter')->with("echecAjout", "Numero RNE existe deja");
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
            return redirect()->route('goEtablissement');
        }

        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        $etablissement = Etablissement::findOrFail($id);
        return view('etablissementUpdate', compact("etablissement",'territoires','types','specialites','villes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etablissement $etablissement)
    {
        $etablissement->delete($etablissement);

        $etablissement->insert([
            'ETABCode' => $_POST['ETABCode'],
            'ETABNom' => $_POST['ETABNom'],
            'ETABMail' => $_POST['ETABMail'],
            'ETABChef' => $_POST['ETABChef'],
            'ETABAdresse' => $_POST['ETABAdresse'],
            'ETABTel' => $_POST['ETABTel'],
            'TERRCode' => $_POST['TERRCode'],
            'TYPCode' => $_POST['TYPCode'],
            'SPECode' => $_POST['SPECode'],
            'VILCode' => $_POST['VILCode']
        ]);

        return redirect('/etablissement')->with("successModify", "L'etablissement' '$request->ETABNom' a été mise à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Etablissement $etablissement)
    {
        if(Gate::denies('updateDelete-users') ) {
            return redirect()->route('goEtablissement');
        }

        $nometab = $etablissement->ETABNom;
        $etablissement->delete();

        return back()->with("successDelete", "L'etablissement' '$nometab' a été supprimé avec succèss");
    }

    public function search(){
        $q = request()->input('q');


        $etablissements2 = Etablissement::where('ETABCode','like',"%$q%")
            ->orWhere('ETABNom','like',"%$q%")
            ->orWhere('ETABMail','like',"%$q%")
            ->orWhere('ETABChef','like',"%$q%")
            ->orWhere('ETABAdresse','like',"%$q%")
            ->orWhere('ETABTel','like',"%$q%")
            ->orWhere('TERRCode','like',"%$q%")
            ->orWhere('TYPCode','like',"%$q%")
            ->orWhere('SPECode','like',"%$q%")
            ->orWhere('VILCode','like',"%$q%")
            ->get();

        $etablissements = $etablissements2 -> where('ETABCode','!=',"Aucun");

        return view('etablissementSearch')->with('etablissement', $etablissements);
    }

    public function recherche(){
        $q = request()->input('q');
        $etablissements2 = Etablissement::where('ETABCode','like',"%$q%")
            ->orWhere('ETABNom','like',"%$q%")
            ->orWhere('ETABMail','like',"%$q%")
            ->orWhere('ETABChef','like',"%$q%")
            ->orWhere('ETABAdresse','like',"%$q%")
            ->orWhere('ETABTel','like',"%$q%")
            ->orWhere('TERRCode','like',"%$q%")
            ->orWhere('TYPCode','like',"%$q%")
            ->orWhere('SPECode','like',"%$q%")
            ->orWhere('VILCode','like',"%$q%")
            ->get();

        $etablissements = $etablissements2 -> where('ETABCode','!=',"Aucun");

        return view('etablissementSearch')->with('etablissement', $etablissements);
    }

    public function affiche($id2){

        $etablissement = Etablissement::find($id2);
        $territoire= Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();




        return view("etablissementAffichage", compact("etablissement",'territoire','type','specialite','ville','coordonnee'));
    }


    public function filtre(){
        $q = request()->input('q');
        $p = request()->input('p');
        $etablissements2 = Etablissement::Where('TERRCode','LIKE',"%$q%")
            ->Where('TYPCode','LIKE',"%$p%")
            ->get();

        $etablissements = $etablissements2 -> where('ETABCode','!=',"Aucun");

        return view('etablissementFiltre')->with('etablissement', $etablissements);
    }

    public function telechargerPdf($id3){

        $etablissement = Etablissement::findOrFail($id3);
        $territoire= Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();

        $pdf = FacadePdf::loadView('telechargement1',compact('etablissement','territoire','type','specialite','ville'));
        return $pdf->download('telechargement1.pdf');
    }
}
