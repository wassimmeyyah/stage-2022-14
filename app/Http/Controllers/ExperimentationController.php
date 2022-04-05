<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use PDF;
use App\Models\Type;
use App\Models\Ville;
use App\Models\Palier;
use App\Models\Archive;
use App\Models\Porteur;
use App\Models\Coordonnee;
use App\Models\Specialite;
use App\Models\Territoire;
use App\Models\Thematique;
use Illuminate\Http\Request;

use App\Models\Etablissement;
use App\Models\Personnelacad;
use App\Models\Accompagnement;
use App\Models\Experimentation;
use App\Models\Groupethematique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Console\Input\Input;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ExperimentationController extends Controller
{
    public function  show(Request $request)
    {


        $groupethematiques = Groupethematique::all();
        $thematiques  = Thematique::all();
        $paliers = Palier::all();
        $porteurs = Porteur::all();
        $personnelacads = Personnelacad::all();
        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();


        $experimentations = DB::table('etablissement as e')->select(
            'e.ETABCode as ETABCode',
            'e.ETABNom as ETABNom',
            'e.ETABMail as ETABMail',
            'e.TERRCode as TERRCode',
            'ex.EXPCode as EXPCode',
            't.TERRCode',
            't.TERRNom as TERRNom',
            'ex.EXPTitre as EXPTitre',
            'ex.EXPLienInternet as EXPLienInternet',
            'ex.EXPLienDrive as EXPLienDrive',
            'ex.EXPDateDebut as EXPDateDebut',
            'ex.EXPArchivage as EXPArchivage',
            'ex.PALCode as PALCode'

        )
            ->leftjoin('experimentation as ex', 'ex.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('territoire as t', 't.TERRCode', '=', 'e.TERRCode')

            ->Orderby("ETABNom","asc")->paginate(10);




        return view("experimentation", ["experimentations" => $experimentations], compact( 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
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



        try {
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


            if (null !== $request->input('THEMALibelle0')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle0')
                ]);
            }
            if (null !== $request->input('THEMALibelle1')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle1')
                ]);
            }
            if (null !== $request->input('THEMALibelle2')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle2')
                ]);
            }
            if (null !== $request->input('THEMALibelle3')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle3')
                ]);
            }
            if (null !== $request->input('THEMALibelle4')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle4')
                ]);
            }
            if (null !== $request->input('THEMALibelle5')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle5')
                ]);
            }
            if (null !== $request->input('THEMALibelle6')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle6')
                ]);
            }
            if (null !== $request->input('THEMALibelle7')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle7')
                ]);
            }
            if (null !== $request->input('THEMALibelle8')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle8')
                ]);
            }
            if (null !== $request->input('THEMALibelle9')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle9')
                ]);
            }
            if (null !== $request->input('THEMALibelle10')) {
                $res4 = DB::table('thematique_abordee')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'THEMACode' => $request->input('THEMALibelle10')
                ]);
            }


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
    }catch(QueryException $q){
            return redirect('/experimentation/ajouter')->with("echecAjout", "Veuillez saisir un numero RNE qui n'existe pas déja");

        }}


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

        return redirect('/experimentation')->with("successModify", "L'experimentation' '$request->EXPTitre' a été mise à jour avec succès");
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

        $res = DB::table('experimentation')->insert([

            'EXPTitre' => $experimentation->EXPTitre,
            'EXPLienInternet' => $experimentation->EXPLienInternet,
            'EXPLienDrive' => $experimentation->EXPLienDrive,
            'EXPDateDebut' => $experimentation->EXPDateDebut,
            'ETABCode' => $experimentation->ETABCode,
            'PALCode' => $experimentation->PALCode
        ]);

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
        $r = request()->input('r');
        $s = request()->input('s');
        $experimentation = DB::table('experimentation as e')->select(
            'e.EXPCode as expID',
            'e.EXPTitre',
            'e.EXPLienInternet',
            'e.EXPLienDrive',
            'e.EXPDateDebut',
            'e.EXPArchivage',
            'e.ETABCode',
            'e.GTCode',
            'e.THEMACode',
            'e.PALCode',
            'et.TERRCode',
            'et.TYPCode',
            'ta.THEMACode as themaID',
            't.THEMACode',
            'e.EXPCode'
        )

            ->leftjoin('etablissement as et', 'et.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('thematique_abordee as ta', 'ta.EXPCode', '=', 'e.EXPCode')
            ->leftjoin('thematique as t', 't.THEMACode', '=', 'ta.THEMACode')
            ->where('et.TERRCode', 'LIKE', "%$q%")
            ->Where('et.TYPCode', 'LIKE', "%$p%")
            ->Where('e.EXPArchivage', 'like', "%$r%")
            ->Where('t.THEMACode', 'LIKE', "%$s%")
            ->get();

//ddd($experimentation);
        return view('experimentationFiltre', compact('experimentation'))->with('experimentation', $experimentation);
    }

    public function affiche($id2)
    {

        $experimentation = Experimentation::find($id2);
        $accompagnements = Accompagnement::where('EXPCode', $experimentation->EXPCode);

        $etablissement = Etablissement::where('ETABCode', $experimentation->ETABCode)->first();
        $groupethematique = Groupethematique::where('GTCode', $experimentation->GTCode)->first();
        //$thematique  = Thematique::where('THEMACode', $experimentation->THEMACode)->first();
        $palier = Palier::where('PALCode', $experimentation->PALCode)->first();
        //$porteurs = Porteur::all();
        // $personnelacads=Personnelacad::where('PACode', $accompagnements->PACode)->get();
        $porteurs = DB::table('porteur as p')->select(
            'p.PORTCode as porteurID',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode',
            'e.EXPCode'
        )
            ->leftjoin('accompagnement as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')
            ->where( 'e.EXPCode',$id2)
            ->get();

        $personnelacads = DB::table('personnelacad as pe')->select(
            'pe.PACode as personneID',
            'pe.PANom',
            'pe.PAPrenom',
            'pe.PAMail',
            'pe.PADiscipline',
            'pe.PAAdressePerso',
            'pe.PATel',
            'pe.ETABCode',
            'e.EXPCode'
        )

            ->leftjoin('accompagnement as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where( 'e.EXPCode',$id2)
            ->get();

        $thematiques= DB::table('thematique as t')->select(
            't.THEMACode as themaID',
            't.THEMALibelle',
            'e.EXPCode'
        )

            ->leftjoin('thematique_abordee as ta', 'ta.THEMACode', '=', 't.THEMACode')
            ->leftjoin('experimentation as e', 'ta.EXPCode', '=', 'e.EXPCode')

            ->where( 'e.EXPCode',$id2)
            ->get();


        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();



        return view("experimentationAffichage", compact("experimentation", 'accompagnements', 'etablissement', 'groupethematique', 'thematiques', 'palier', 'territoire', 'type', 'specialite', 'ville', 'coordonnee', 'porteurs','personnelacads'));
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


    public function archiver(Experimentation $experimentation)
    {
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }

        $nometab = $experimentation->EXPTitre;

        $res = DB::table('experimentation')->insert([

            'EXPTitre' => $experimentation->EXPTitre,
            'EXPLienInternet' => $experimentation->EXPLienInternet,
            'EXPLienDrive' => $experimentation->EXPLienDrive,
            'EXPDateDebut' => $experimentation->EXPDateDebut,
            'ETABCode' => $experimentation->ETABCode,
            'PALCode' => $experimentation->PALCode
        ]);

        $experimentation->delete($experimentation);

        return back()->with("successDelete", "L'experimentation' '$nometab' a été supprimé avec succèss");
    }


}
