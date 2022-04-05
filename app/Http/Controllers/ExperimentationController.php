<?php

namespace App\Http\Controllers;

use App\Models\Accompagnement;
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
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Console\Input\Input;

class ExperimentationController extends Controller
{
    public function  show(Request $request)
    {

        $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom", "asc");
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads = Personnelacad::all();
        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        if (isset($request->Recherche)) {
            $searchValue = $request->Recherche;
            $experimentations = \App\Models\experimentation::where('EXPCode', 'LIKE', $searchValue . '%')->get();
        } else {
            $experimentations = \App\Models\experimentation::orderBy("EXPCode", "asc")->paginate(10);
        }

        return view("experimentation", ["experimentations" => $experimentations], compact('etablissements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
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
        if (Gate::denies('create-users')) {
            return redirect()->route('goExperimentation');
        }

        $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom", "asc")->get();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $porteurs2 = Porteur::whereNull('PORTNom');
        $personnelacads = Personnelacad::all();
        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();
        $accompagnements = Accompagnement::all();

        return view('experimentationCreate', compact('accompagnements', 'etablissements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
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
        $etablissements = Etablissement::orderBy("ETABNom", "asc");
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads = Personnelacad::all();
        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();
        $accompagnements = Accompagnement::all();
        $id = #some_;



            $res = DB::table('experimentation')->insert([

                'EXPTitre' => $request->input('EXPTitre'),
                'EXPLienInternet' => $request->input('EXPLienInternet'),
                'EXPLienDrive' => $request->input('EXPLienDrive'),
                'EXPDateDebut' => $request->input('EXPDateDebut'),
                'ETABCode' => $request->input('ETABCode'),
                'PALCode' => $request->input('PALCode')
            ]);

        $res2 = DB::table('etablissement')->insert([
            'ETABCode' => $request->input('ETABCode'),
            'ETABNom' => $request->input('ETABNom'),
            'ETABMail' => $request->input('ETABMail'),
            'ETABChef' => $request->input('ETABChef'),
            'ETABAdresse' => $request->input('ETABAdresse'),
            'ETABTel' => $request->input('ETABTel'),
            'TERRCode' => $request->input('TERRCode'),
            'TYPCode' => $request->input('TYPCode'),
            'SPECode' => $request->input('SPECode'),
            'VILCode' => $request->input('VILCode')
        ]);

        if (null !== $request->input('PORTNom0')) {
            $res3 = DB::table('porteur')->insert([


                'PORTNom' => $request->input('PORTNom0'),
                'PORTMail' => $request->input('PORTMail0'),
                'PORTTel' => $request->input('PORTTel0'),
                'ETABCode' => $request->input('ETABCode')

            ]);
        }
        if (null !== $request->input('PORTNom1')) {
            $res5 = DB::table('porteur')->insert([


                'PORTNom' => $request->input('PORTNom1'),
                'PORTMail' => $request->input('PORTMail1'),
                'PORTTel' => $request->input('PORTTel1'),
                'ETABCode' => $request->input('ETABCode')
            ]);
        }

        if (null !== $request->input('PORTNom2')) {
            $res6 = DB::table('porteur')->insert([


                'PORTNom' => $request->input('PORTNom2'),
                'PORTMail' => $request->input('PORTMail2'),
                'PORTTel' => $request->input('PORTTel2'),
                'ETABCode' => $request->input('ETABCode')
            ]);
        }

        

            $res6 = DB::table('thematique_abordee')->insert([



                'THEMACode' => $request->input('THEMACode'),
                'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode
            ]);
        



        //ddd($request->input('PANom1'));
        //ddd(DB::table('porteur')->latest('PORTCode')->limit($id)->get());


        foreach (DB::table('porteur')->latest('PORTCode')->limit(3)->get() as $e) {
            if ($e->ETABCode == $request->input('ETABCode')) {
                if (null !== $request->input('PANom0')) {
                    $res4 = DB::table('accompagnement')->insert([

                        'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                        'PORTCode' => $e->PORTCode,
                        'PACode' => $request->input('PANom0')
                    ]);
                }
            }
        }

        foreach (DB::table('porteur')->latest('PORTCode')->limit(3)->get() as $e) {
            if ($e->ETABCode == $request->input('ETABCode')) {
                if (null !== $request->input('PANom1')) {
                    $res4 = DB::table('accompagnement')->insert([

                        'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                        'PORTCode' => $e->PORTCode,
                        'PACode' => $request->input('PANom1')
                    ]);
                }
            }
        }


        foreach (DB::table('porteur')->latest('PORTCode')->limit(3)->get() as $e) {
            if ($e->ETABCode == $request->input('ETABCode')) {
                if (null !== $request->input('PANom2')) {
                    $res4 = DB::table('accompagnement')->insert([

                        'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                        'PORTCode' => $e->PORTCode,
                        'PACode' => $request->input('PANom2')
                    ]);
                }
            }
        }


        //$res7 = Porteur::whereNull('PORTNom') ->delete();





        return redirect()->route('goExperimentation', compact('etablissements', 'accompagnements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'))->with("successAjout", "l'experimentation' '$request->EXPTitre'a été ajouté avec succès");
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
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }

        $etablissements = Etablissement::all();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();

        $experimentation = Experimentation::findOrFail($id);
        return view('experimentationUpdate', compact("experimentation", 'etablissements', 'groupethematiques', 'thematiques', 'paliers'));
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
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }

        $nometab = $experimentation->EXPTitre;
        $experimentation->delete($experimentation);

        return back()->with("successDelete", "L'experimentation' '$nometab' a été supprimé avec succèss");
    }

    public function search()
    {
        $q = request()->input('q');
        $experimentations = Experimentation::where('EXPCode', 'like', "%$q%")
            ->orWhere('EXPTitre', 'like', "%$q%")
            ->orWhere('ETABCode', 'like', "%$q%")
            ->get();

        return view('experimentationSearch')->with('experimentation', $experimentations);
    }
    public function recherche()
    {
        $q = request()->input('q');
        $experimentations = Experimentation::where('EXPCode', 'like', "%$q%")
            ->orWhere('EXPTitre', 'like', "%$q%")
            ->orWhere('ETABCode', 'like', "%$q%")
            ->get();




        return view('experimentationSearch2')->with('experimentation', $experimentations);
    }

    public function filtre()
    {
        $q = request()->input('q');
        $p = request()->input('p');
        $etablissements2 = Etablissement::Where('TERRCode', 'LIKE', "%$q%")
            ->Where('TYPCode', 'LIKE', "%$p%")
            ->get();

        $etablissements = $etablissements2->where('ETABCode', '!=', "Aucun");
        $experimentations = new Experimentation();
        foreach ($etablissements as $etablissement) {
            $exper = Experimentation::where('ETABCode', $etablissement->ETABCode);
            $experimentations->push($exper);
        }


        return view('experimentationFiltre')->with('experimentations', $experimentations);
    }

    public function affiche($id2)
    {

        $experimentation = Experimentation::find($id2);
        $accompagnements = Accompagnement::where('EXPCode', $experimentation->EXPCode);

        $etablissement = Etablissement::where('ETABCode', $experimentation->ETABCode)->first();
        $groupethematique = Groupethematique::where('GTCode', $experimentation->GTCode)->first();
        $thematique  = Thematique::where('THEMACode', $experimentation->THEMACode)->first();
        $palier = Palier::where('PALCode', $experimentation->PALCode)->first();
        // $porteurs = Porteur::where('PORTCode', $accompagnements->PACode)->get();
        // $personnelacads=Personnelacad::where('PACode', $accompagnements->PACode)->get();
        $porteurs = DB::table('porteur as p')->select(
            'p.PORTCode as porteurID',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode'
        )
            ->where('porteur.PORTCode', '=', 'accompagnement.PORTCode')->get();

        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();



        return view("experimentationAffichage", compact("experimentation", 'accompagnements', 'etablissement', 'groupethematique', 'thematique', 'palier', 'territoire', 'type', 'specialite', 'ville', 'coordonnee', 'porteurs', 'personnelacads'));
    }

    public function telechargerPdf($id3)
    {

        $etablissements = Etablissement::all();
        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();

        $experimentation = Experimentation::findOrFail($id3);

        $pdf = FacadePdf::loadView('telechargement4', compact("experimentation", 'etablissements', 'groupethematiques', 'thematiques', 'paliers'));
        return $pdf->download('telechargement4.pdf');
    }
}
