<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Type;
use App\Models\Ville;
use App\Models\Palier;
use App\Models\Porteur;
use App\Models\Coordonnee;
use App\Models\Specialite;
use App\Models\Territoire;
use App\Models\Thematique;
use Illuminate\Http\Request;

use App\Models\Etablissement;
use App\Models\Personnelacad;
use App\Models\Experimentation;
use App\Models\Groupethematique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ExperimentationController extends Controller
{
    public function  show(Request $request){

        $etablissements= Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom","asc");
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads=Personnelacad::all();
        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        if(isset($request->Recherche)) {
            $searchValue = $request->Recherche;
            $experimentations = \App\Models\experimentation::where('EXPCode','LIKE', $searchValue . '%')->get();

        }else {
            $experimentations = \App\Models\experimentation::orderBy("EXPCode","asc")->paginate(10);

        }

        return view("experimentation", ["experimentations" => $experimentations], compact('etablissements','groupethematiques','thematiques','paliers','porteurs','personnelacads','territoires','types','specialites','villes'));
    }

    public function index()
    {
        $experimentation = Experimentation::all();

        return view('index', compact('experimentation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users') ) {
            return redirect()->route('goExperimentation');
        }

        $etablissements= Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom","asc")->get();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads=Personnelacad::all();
        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        return view('experimentationCreate', compact('etablissements','groupethematiques','thematiques','paliers','porteurs','personnelacads','territoires','types','specialites','villes'));
    }

    public function up(Experimentation $experimentation)
    {
        return view('experimentationUpdate', compact("experimentation"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etablissements= Etablissement::orderBy("ETABNom","asc");
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads=Personnelacad::all();
        $territoires= Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        $res = DB::table('experimentation')->insert([

            'EXPTitre' => $_POST['EXPTitre'],
            'EXPLienInternet' => $_POST['EXPLienInternet'],
            'EXPLienDrive' => $_POST['EXPLienDrive'],
            'EXPDateDebut' => $_POST['EXPDateDebut'],
            'ETABCode' => $_POST['ETABCode'],
            'PALCode' => $_POST['PALCode'],
            'THEMACode' => $_POST['THEMACode']
        ]);

        $res2 = DB::table('etablissement')->insert([
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

        $res3 = DB::table('porteur')->insert([

            'PORTCode' => $_POST['PORTCode'],
            'PORTNom' => $_POST['PORTNom'],
            'PORTMail' => $_POST['PORTMail'],
            'PORTTel' => $_POST['PORTTel'],
            'ETABCode' => $_POST['ETABCode']
        ]);

        $res4 = DB::table('coordination')->insert([

            'ETABCode' => $_POST['ETABCode'],
            'PORTCode' => $_POST['PORTCode'],
            'INSPCode' => $_POST['PACode']
        ]);




        return redirect('/experimentation', compact('etablissements','groupethematiques','thematiques','paliers','porteurs','personnelacads','territoires','types','specialites','villes'))->with("successAjout", "l'experimentation' '$request->EXPTitre'a été ajouté avec succès");
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
            return redirect()->route('goExperimentation');
        }

        $etablissements= Etablissement::all();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();

        $experimentation = Experimentation::findOrFail($id);
        return view('experimentationUpdate', compact("experimentation",'etablissements','groupethematiques','thematiques','paliers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experimentation $experimentation)
    {




        $experimentation->delete($experimentation);

        $experimentation->insert([
            'EXPCode' => $_POST['EXPCode'],
            'EXPTitre' => $_POST['EXPTitre'],
            'EXPLienInternet' => $_POST['EXPLienInternet'],
            'EXPLienDrive' => $_POST['EXPLienDrive'],
            'EXPDateDebut' => $_POST['EXPDateDebut'],
            'ETABCode' => $_POST['ETABCode'],

            'PALCode' => $_POST['PALCode']
        ]);

        return redirect('/experimentation')->with("successModify", "L'experimentation' '$request->EXPTitre' a été mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Experimentation $experimentation)
    {
        if(Gate::denies('updateDelete-users') ) {
            return redirect()->route('goExperimentation');
        }
        
        $nometab = $experimentation->EXPTitre;
        $experimentation->delete($experimentation);

        return back()->with("successDelete", "L'experimentation' '$nometab' a été supprimé avec succèss");
    }

    public function search(){
        $q = request()->input('q');
        $experimentations = Experimentation::where('EXPCode','like',"%$q%")
            ->orWhere('EXPTitre','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();

        return view('experimentationSearch')->with('experimentation', $experimentations);
    }
    public function recherche(){
        $q = request()->input('q');
        $experimentations = Experimentation::where('EXPCode','like',"%$q%")
            ->orWhere('EXPTitre','like',"%$q%")
            ->orWhere('ETABCode','like',"%$q%")
            ->get();




        return view('experimentationSearch2')->with('experimentation', $experimentations);
    }

    public function filtre(){
        $q = request()->input('q');
        $p = request()->input('p');
        $etablissements2 = Etablissement::Where('TERRCode','LIKE',"%$q%")
            ->Where('TYPCode','LIKE',"%$p%")
            ->get();

        $etablissements = $etablissements2 -> where('ETABCode','!=',"Aucun");
        $experimentations= new Experimentation();
        foreach($etablissements as $etablissement) {
            $exper = Experimentation::where('ETABCode', $etablissement->ETABCode);
            $experimentations->push($exper);
        }


        return view('experimentationFiltre')->with('experimentations', $experimentations);
    }

    public function affiche($id2){

        $experimentation = Experimentation::find($id2);

        $etablissement= Etablissement::where('ETABCode', $experimentation->ETABCode)->first();
        $groupethematique = Groupethematique::where('GTCode', $experimentation->GTCode)->first();
        $thematique  = Thematique::where('THEMACode', $experimentation->THEMACode)->first();
        $palier = Palier::where('PALCode', $experimentation->PALCode)->first();
        $porteurs = Porteur::all();
        $personnelacads=Personnelacad::all();
        $territoire= Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();



        return view("experimentationAffichage", compact("experimentation",'etablissement','groupethematique','thematique','palier','territoire','type','specialite','ville','coordonnee'));
    }

    public function telechargerPdf($id3){

        $etablissements= Etablissement::all();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();

        $experimentation = Experimentation::findOrFail($id3);

        $pdf = FacadePdf::loadView('telechargement4', compact("experimentation",'etablissements','groupethematiques','thematiques','paliers'));
        return $pdf->download('telechargement4.pdf');
    }
}

