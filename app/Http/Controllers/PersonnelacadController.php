<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

use App\Models\Etablissement;
use App\Models\Personnelacad;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PersonnelacadController extends Controller
{
    public function  show(Request $request){

        if(isset($request->Recherche)) {
            $searchValue = $request->Recherche;
            $personnelacads = \App\Models\Personnelacad::where('PACode','LIKE', $searchValue . '%')->get();
            //return view("viewPersonnelacad", ["personnelacads" => $personnelacads]);
        }else {
            $personnelacads = \App\Models\Personnelacad::orderBy("PACode","asc")->paginate(10);
            //return view("personnelacad", ["personnelacads" => $personnelacads]);
        }

        return view("personnelacad", ["personnelacads" => $personnelacads]);}

    public function show2(Request $request){
        $personnelacads = \App\Models\Personnelacad::orderBy("PACode","asc")->get();
        return view('ListeMailPersonnelacad',["personnelacads" => $personnelacads]);
    }

    public function index()
    {
        $personnelacad = Personnelacad::all();

        return view('index', compact('personnelacad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users') ) {
            return redirect()->route('goPersonnelacad');
        }

        return view('personnelacadCreate');
    }

    public function up(Personnelacad $personnelacad)
    {
        return view('personnelacadUpdate', compact("personnelacad"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $res = DB::table('personnelacad')->insert([

            'PANom' => $_POST['PANom'],
            'PAPrenom' => $_POST['PAPrenom'],
            'PAMail' => $_POST['PAMail'],
            'PADiscipline' => $_POST['PADiscipline'],
            'PAAdressePerso' => $_POST['PAAdressePerso'],
            'PATel' => $_POST['PATel'],
            'ETABCode' => $_POST['ETABCode']
        ]);


        return redirect('/personnelacad')->with("successAjout", "la personne' '$request->PANom'a été ajoutée avec succès");
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
            return redirect()->route('goPersonnelacad');
        }

        $personnelacad = Personnelacad::findOrFail($id);
        return view('personnelacadUpdate', compact("personnelacad"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnelacad $personnelacad)
    {




        $personnelacad->delete($personnelacad);

        $personnelacad->insert([
            'PACode' => $_POST['PACode'],
            'PANom' => $_POST['PANom'],
            'PAPrenom' => $_POST['PAPrenom'],
            'PAMail' => $_POST['PAMail'],
            'PADiscipline' => $_POST['PADiscipline'],
            'PAAdressePerso' => $_POST['PAAdressePerso'],
            'PATel' => $_POST['PATel'],
            'ETABCode' => $_POST['ETABCode']
        ]);

        return redirect('/personnelacad')->with("successModify", "La personne' '$request->PANom' a été mise à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Personnelacad $personnelacad)
    {
        if(Gate::denies('updateDelete-users') ) {
            return redirect()->route('goPersonnelacad');
        }

        $nomPA = $personnelacad->PANom;
        $personnelacad->delete();

        return back()->with("successDelete", "La personne' '$nomPA' a été supprimée avec succèss");
    }

    public function search(){
        $q = request()->input('q');
        $personnelacads = Personnelacad::where('PACode','like',"%$q%")
            ->orWhere('PANom','like',"%$q%")
            ->orWhere('PAPrenom','like',"%$q%")
            ->orWhere('PAMail','like',"%$q%")
            ->orWhere('PAdiscipline', 'like',"%$q%")
            ->orWhere('PAAdressePerso','like',"%$q%")
            ->orWhere('PATel','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();

        return view('personnelacadSearch')->with('personnelacad', $personnelacads);
    }

    public function recherche(){
        $q = request()->input('q');
        $personnelacads = Personnelacad::where('PACode','like',"%$q%")
            ->orWhere('PANom','like',"%$q%")
            ->orWhere('PAPrenom','like',"%$q%")
            ->orWhere('PAMail','like',"%$q%")
            ->orWhere('PAdiscipline', 'like',"%$q%")
            ->orWhere('PAAdressePerso','like',"%$q%")
            ->orWhere('PATel','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();

        return view('personnelacadSearch')->with('personnelacad', $personnelacads);
    }

    public function affiche($id2){

        $etablissements = Etablissement::all();


        $personnelacad = Personnelacad::find($id2);

        return view("personnelacadAffichage", compact("etablissements", "personnelacad"));
    }


    public function telechargerPdf($id3){

        $etablissements= Etablissement::all();

        $personnelacad = Personnelacad::findOrFail($id3);

        $pdf = FacadePdf::loadView('telechargement3',compact('personnelacad'));
        return $pdf->download('telechargement3.pdf');
    }

}
