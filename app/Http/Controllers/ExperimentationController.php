<?php

namespace App\Http\Controllers;

use App\Models\Accompagnment3;
use App\Models\Accompagnment4;
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
use App\Models\Accompagnement1;
use App\Models\Accompagnement2;
use App\Models\Experimentation;
use App\Models\Groupethematique;
use App\Models\Thematique_abordee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
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


        $experimentations = DB::table('experimentation as ex')->select(
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
            ->leftjoin('etablissement as e', 'ex.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('territoire as t', 't.TERRCode', '=', 'e.TERRCode')

            ->Orderby("EXPTitre", "asc")->paginate(10);


        return view("experimentation", ["experimentations" => $experimentations], compact('groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
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
        $accompagnement1s = Accompagnement::all();
        $accompagnement2s = Accompagnement::all();

        return view('experimentationCreate', compact('accompagnement1s','accompagnement2s', 'etablissements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
    }

    public function up()
    {
        Schema::create('accompagnement1', function (Blueprint $table) {
            $table->foreign('EXPCode')->references('EXPCode')
                ->on('experimentation');
            $table->foreign('PORTCode')->references('PORTCode')
                ->on('porteur');


            $table->foreign('EXPCode')->references('EXPCode')->on('experimentation')->onDelete('cascade');
            $table->foreign('PORTCode')->references('PORTCode')->on('porteur')->onDelete('cascade');

        });

        Schema::create('accompagnement2', function (Blueprint $table) {
            $table->foreign('EXPCode')->references('EXPCode')
                ->on('experimentation');
            $table->foreign('PACode')->references('PACode')
                ->on('personnelacad');

            $table->foreign('EXPCode')->references('EXPCode')->on('experimentation')->onDelete('cascade');
            $table->foreign('PACode')->references('PACode')->on('personnelacad')->onDelete('cascade');


        });


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



        //try {
            $res = DB::table('experimentation')->insert([

                'EXPTitre' => $request->input('EXPTitre'),
                'EXPLienInternet' => $request->input('EXPLienInternet'),
                'EXPLienDrive' => $request->input('EXPLienDrive'),
                'EXPDateDebut' => $request->input('EXPDateDebut'),
                'ETABCode' => $request->input('ETABCode'),
                'PALCode' => $request->input('PALCode')
            ]);

            $res = DB::table('coordonnees')->insert([
                'COORDLatitudeLongitude' => "45.74837173982651, 4.83702637056378",
                'COORDLatitude' => "45.74837173982651",
                'COORDLongitude' => "4.83702637056378"
            ]);

            $res2 = DB::table('ville')->insert([
                'VILNom' => $request->input('VILCode'),
            ]);

            ddd(DB::table('ville')->latest('VILCode')->limit(1)->first()->VILCode);

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
                'VILCode' => DB::table('ville')->latest('VILCode')->limit(1)->first()->VILCode,
                'COORDCode' => DB::table('coordonnees')->latest('COORDCode')->limit(1)->first()->COORDCode
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



            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                'THEMACode' => $request->input('THEMALibelle0')
            ]);

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
                        $res4 = DB::table('accompagnement1')->insert([

                            'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                            'PORTCode' => $e->PORTCode,
                        ]);
                    }
                }







            if (null !== $request->input('PANom0')) {
                $res4 = DB::table('accompagnement2')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'PACode' => $request->input('PANom0')
                ]);
            }

            if (null !== $request->input('PANom1')) {
                $res4 = DB::table('accompagnement2')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'PACode' => $request->input('PANom1')
                ]);
            }

            if (null !== $request->input('PANom2')) {
                $res4 = DB::table('accompagnement2')->insert([

                    'EXPCode' => DB::table('experimentation')->latest('EXPCode')->first()->EXPCode,
                    'PACode' => $request->input('PANom2')
                ]);
            }


            //$res7 = Porteur::whereNull('PORTNom') ->delete();






            return redirect()->route('goExperimentation', compact('etablissements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'))->with("successAjout", "l'experimentation' '$request->EXPTitre'a été ajouté avec succès");
//            } catch (QueryException $q) {
//              return redirect('/experimentation/ajouter')->with("echecAjout", "Veuillez saisir un numero RNE qui n'existe pas déja et au moins une thématique, au moins un palier, un porteur et un accompagnateur ");
//          }
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

        $experimentation = Experimentation::findOrFail($id);
        $etablissement = Etablissement::where('ETABCode', '=', $experimentation->ETABCode)->first();
        $groupethematiques = Groupethematique::all();
        $thems = Thematique::all();
        $thematiques = DB::table('thematique as t')->select(
            't.THEMACode as THEMACode',
            't.THEMALibelle',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('thematique_abordee as ta', 'ta.THEMACode', '=', 't.THEMACode')
            ->leftjoin('experimentation as e', 'ta.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id)
            ->get();
        $paliers = Palier::all();


        return view('experimentationUpdate', compact("experimentation", 'etablissement', 'groupethematiques', 'thematiques', 'thems', 'paliers'));
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




        $res = DB::table('experimentation')->where('EXPCode', '=', $experimentation->EXPCode)
            ->update([


                'EXPLienInternet' => $request->input('EXPLienInternet'),
                'EXPLienDrive' => $request->input('EXPLienDrive'),
                'PALCode' => $request->input('PALCode')
            ]);

        if (null !== $request->input('THEMALibelle0')) {
            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => $experimentation->EXPCode,
                'THEMACode' => $request->input('THEMALibelle0')
            ]);
        }
        if (null !== $request->input('THEMALibelle1')) {
            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => $experimentation->EXPCode,
                'THEMACode' => $request->input('THEMALibelle1')
            ]);
        }
        if (null !== $request->input('THEMALibelle2')) {
            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => $experimentation->EXPCode,
                'THEMACode' => $request->input('THEMALibelle2')
            ]);
        }
        if (null !== $request->input('THEMALibelle3')) {
            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => $experimentation->EXPCode,
                'THEMACode' => $request->input('THEMALibelle3')
            ]);
        }
        if (null !== $request->input('THEMALibelle4')) {
            $res4 = DB::table('thematique_abordee')->insert([

                'EXPCode' => $experimentation->EXPCode,
                'THEMACode' => $request->input('THEMALibelle4')
            ]);
        }

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

        $nomEXP = $experimentation->EXPTitre;

        $thematiques = DB::table('thematique as t')->select(
            't.THEMACode as THEMACode',
            't.THEMALibelle',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('thematique_abordee as ta', 'ta.THEMACode', '=', 't.THEMACode')
            ->leftjoin('experimentation as e', 'ta.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $experimentation->EXPCode)
            ->get();

        $porteurs = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('accompagnement1 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $experimentation->EXPCode)
            ->get();

        $personnelacads = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('accompagnement2 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $experimentation->EXPCode)
            ->get();

        $porteur1s = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('accompagnement3 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $experimentation->EXPCode)
            ->get();

        $personnelacad1s = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'e.EXPCode as EXPCode'
        )

            ->leftjoin('accompagnement4 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $experimentation->EXPCode)
            ->get();

        foreach($thematiques as $thematique) {
            $res10 = DB::table('thematique_abordee')->where('THEMACode', '=', $thematique->THEMACode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();
        }

        foreach($porteurs as $porteur) {
            $res = DB::table('accompagnement1')->where('PORTCode', '=', $porteur->PORTCode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();
        }

        foreach ($personnelacads as $personnelacad){
            $res10 = DB::table('accompagnement2')->where('PACode', '=', $personnelacad->PACode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();
        }

        foreach($porteur1s as $porteur) {
            $res = DB::table('accompagnement3')->where('PORTCode', '=', $porteur->PORTCode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();
        }

        foreach ($personnelacad1s as $personnelacad){
            $res10 = DB::table('accompagnement4')->where('PACode', '=', $personnelacad->PACode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();
        }

        $experimentation->delete();

        return back()->with("successDelete", "L'experimentation'' '$nomEXP' a été supprimé avec succèss");
    }

    public function search()
    {
        $q = request()->input('q');
        $experimentations = DB::table('experimentation as ex')->select(
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
            ->leftjoin('etablissement as e', 'ex.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('territoire as t', 't.TERRCode', '=', 'e.TERRCode')
            ->orWhere('ex.EXPTitre', 'like', "%$q%")
            ->orWhere('e.ETABNom', 'like', "%$q%")
            ->orWhere('t.TERRNom', 'like', "%$q%")
            ->Orderby("EXPTitre", "asc")
            ->get();

            //ddd($experimentations);


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
        $s = request()->input('s');
        $experimentation = DB::table('experimentation as e')->select(
            'e.EXPCode as expID',
            'e.EXPTitre',
            'e.EXPLienInternet',
            'e.EXPLienDrive',
            'e.EXPDateDebut',
            'e.EXPArchivage',
            'e.ETABCode',
            'e.PALCode',
            'e.EXPCode',
            'et.ETABNom as ETABNom',
            'te.TERRNom as TERRNom'
        )

            ->leftjoin('etablissement as et', 'et.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('thematique_abordee as ta', 'ta.EXPCode', '=', 'e.EXPCode')
            ->leftjoin('thematique as t', 't.THEMACode', '=', 'ta.THEMACode')
            ->leftjoin('territoire as te', 'te.TERRCode', '=', 'et.TERRCode')
            ->where('et.TERRCode', 'LIKE', "%$q%")
            ->Where('et.TYPCode', 'LIKE', "%$p%")

            ->Where('ta.THEMACode', 'LIKE', "%$s%")->distinct()->orderBy('e.EXPCode')
            ->Orderby("EXPTitre", "asc")
            ->get();

        // ddd($experimentation);
        return view('experimentationFiltre', compact('experimentation'))->with('experimentation', $experimentation);
    }

    public function filtreArchivage()
    {
        $r = request()->input('r');
        $experimentation = DB::table('experimentation as e')->select(
            'e.EXPCode as expID',
            'e.EXPTitre',
            'e.EXPLienInternet',
            'e.EXPLienDrive',
            'e.EXPDateDebut',
            'e.EXPArchivage',
            'e.ETABCode',
            'e.PALCode',
            'e.EXPCode',
            'et.ETABNom as ETABNom',
            'te.TERRNom as TERRNom'
        )

            ->leftjoin('etablissement as et', 'et.ETABCode', '=', 'e.ETABCode')
            ->leftjoin('territoire as te', 'te.TERRCode', '=', 'et.TERRCode')

            ->Where('e.EXPArchivage', 'like', "%$r%")
            ->Orderby("EXPTitre", "asc")
            ->get();

        // ddd($experimentation);
        return view('experimentationFiltre', compact('experimentation'))->with('experimentation', $experimentation);
    }

    public function affiche($id2)
    {

        $experimentation = Experimentation::find($id2);
        $accompagnement1s = Accompagnement1::where('EXPCode', $experimentation->EXPCode);
        $accompagnement2s = Accompagnement2::where('EXPCode', $experimentation->EXPCode);
        $accompagnement3s = Accompagnment3::where('EXPCode', $experimentation->EXPCode);
        $accompagnement4s = Accompagnment4::where('EXPCode', $experimentation->EXPCode);

        $etablissement = Etablissement::where('ETABCode', $experimentation->ETABCode)->first();
        $groupethematique = Groupethematique::where('GTCode', $experimentation->GTCode)->first();
        //$thematique  = Thematique::where('THEMACode', $experimentation->THEMACode)->first();
        $palier = Palier::where('PALCode', $experimentation->PALCode)->first();
        //$porteurs = Porteur::all();
        // $personnelacads=Personnelacad::where('PACode', $accompagnements->PACode)->get();
        $porteurs = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode',
            'e.EXPCode'
        )
            ->leftjoin('accompagnement1 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')
            ->where('e.EXPCode', $id2)
            ->get();

        $porteur2s = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode',
            'e.EXPCode'
        )
            ->leftjoin('accompagnement3 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')
            ->where('e.EXPCode', $id2)
            ->get();

        $personnelacads = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'pe.PANom',
            'pe.PAPrenom',
            'pe.PAMail',
            'pe.PADiscipline',
            'pe.PAAdressePerso',
            'pe.PATel',
            'pe.PAFonction',
            'pe.ETABCode',
            'e.EXPCode'
        )

            ->leftjoin('accompagnement2 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id2)
            ->get();

        $personnelacad2s = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'pe.PANom',
            'pe.PAPrenom',
            'pe.PAMail',
            'pe.PADiscipline',
            'pe.PAAdressePerso',
            'pe.PATel',
            'pe.PAFonction',
            'pe.ETABCode',
            'e.EXPCode'
        )

            ->leftjoin('accompagnement4 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id2)
            ->get();

        $thematiques = DB::table('thematique as t')->select(
            't.THEMACode as THEMACode',
            't.THEMALibelle',
            'e.EXPCode'
        )

            ->leftjoin('thematique_abordee as ta', 'ta.THEMACode', '=', 't.THEMACode')
            ->leftjoin('experimentation as e', 'ta.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id2)
            ->get();


        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();

        return view("experimentationAffichage", compact("experimentation", 'accompagnement1s','accompagnement2s','accompagnement3s','accompagnement4s' ,'etablissement', 'groupethematique', 'thematiques', 'palier', 'territoire', 'type', 'specialite', 'ville', 'coordonnee', 'porteurs', 'personnelacads', 'porteur2s', 'personnelacad2s'));
    }

    public function telechargerPdf($id3)
    {

        $experimentation = Experimentation::find($id3);
        $accompagnement1s = Accompagnement1::where('EXPCode', $experimentation->EXPCode);
        $accompagnement2s = Accompagnement2::where('EXPCode', $experimentation->EXPCode);
        $accompagnement3s = Accompagnment3::where('EXPCode', $experimentation->EXPCode);
        $accompagnement4s = Accompagnment4::where('EXPCode', $experimentation->EXPCode);

        $etablissement = Etablissement::where('ETABCode', $experimentation->ETABCode)->first();
        $groupethematique = Groupethematique::where('GTCode', $experimentation->GTCode)->first();
        //$thematique  = Thematique::where('THEMACode', $experimentation->THEMACode)->first();
        $palier = Palier::where('PALCode', $experimentation->PALCode)->first();
        //$porteurs = Porteur::all();
        // $personnelacads=Personnelacad::where('PACode', $accompagnements->PACode)->get();
        $porteurs = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode',
            'e.EXPCode'
        )
            ->leftjoin('accompagnement1 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')
            ->where('e.EXPCode', $id3)
            ->get();

        $porteur2s = DB::table('porteur as p')->select(
            'p.PORTCode as PORTCode',
            'p.PORTNom',
            'p.PORTMail',
            'p.PORTTel',
            'p.ETABCode',
            'e.EXPCode'
        )
            ->leftjoin('accompagnement3 as a', 'a.PORTCode', '=', 'p.PORTCode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')
            ->where('e.EXPCode', $id3)
            ->get();

        $personnelacads = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'pe.PANom',
            'pe.PAPrenom',
            'pe.PAMail',
            'pe.PADiscipline',
            'pe.PAAdressePerso',
            'pe.PATel',
            'pe.PAFonction',
            'pe.ETABCode',
            'e.EXPCode'
        )

            ->leftjoin('accompagnement2 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id3)
            ->get();

        $personnelacad2s = DB::table('personnelacad as pe')->select(
            'pe.PACode as PACode',
            'pe.PANom',
            'pe.PAPrenom',
            'pe.PAMail',
            'pe.PADiscipline',
            'pe.PAAdressePerso',
            'pe.PATel',
            'pe.PAFonction',
            'pe.ETABCode',
            'e.EXPCode'
        )

            ->leftjoin('accompagnement4 as a', 'a.PACode', '=', 'pe.PACode')
            ->leftjoin('experimentation as e', 'a.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id3)
            ->get();

        $thematiques = DB::table('thematique as t')->select(
            't.THEMACode as themaID',
            't.THEMALibelle',
            'e.EXPCode'
        )

            ->leftjoin('thematique_abordee as ta', 'ta.THEMACode', '=', 't.THEMACode')
            ->leftjoin('experimentation as e', 'ta.EXPCode', '=', 'e.EXPCode')

            ->where('e.EXPCode', $id3)
            ->get();


        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();

        $pdf = FacadePdf::loadView('telechargement4', compact("experimentation", 'accompagnement1s','accompagnement2s','accompagnement3s','accompagnement4s' ,'etablissement', 'groupethematique', 'thematiques', 'palier', 'territoire', 'type', 'specialite', 'ville', 'coordonnee', 'porteurs', 'personnelacads', 'porteur2s', 'personnelacad2s'));
        return $pdf->download('telechargement4.pdf');
    }


    public function archiver(Experimentation $experimentation)
    {
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }

        $id = $experimentation->EXPCode;
        $nometab = $experimentation->EXPTitre;

        $res = DB::table('experimentation')
            ->where('EXPCode', '=', $id)
            ->update(['EXPArchivage' => 1]);


        return back()->with("successDelete", "L'experimentation' '$nometab' a été archivée avec succès");
    }

    public function deleteporteur(Experimentation $experimentation, Porteur $porteur)
    {
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }


        try{
        $nomEXP = $porteur->PORTNom;

        //ddd(DB::table('accompagnement1')->where('PORTCode', $porteur->PORTCode)->where('EXPCode',  $experimentation->EXPCode));
        $res4 = DB::table('accompagnement3')->insert([

            'EXPCode' => $experimentation->EXPCode,
            'PORTCode' => $porteur->PORTCode,
        ]);
        $res = DB::table('accompagnement1')->where('PORTCode','=', $porteur->PORTCode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();



        return back()->with("successDelete", "Le porteur' '$nomEXP' a été supprimé avec succèss");
            } catch (QueryException $q) {
                return back()->with("successDelete", "Le porteur' '$nomEXP' a été supprimé avec succèss");
            }

    }

    public function deletepersonnelacad(Experimentation $experimentation, Personnelacad $personnelacad)
    {
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }

        //try{

        $nompersonnel = $personnelacad->PANom;


        $res4 = DB::table('accompagnement4')->insert([

            'EXPCode' => $experimentation->EXPCode,
            'PACode' => $personnelacad->PACode,
        ]);
        $res10 = DB::table('accompagnement2')->where('PACode', '=', $personnelacad->PACode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();



        return back()->with("successDelete2", "L'accompagnateur' '$nompersonnel' a été supprimé avec succèss");
//        } catch (QueryException $q) {
//            return back()->with("successDelete2", "L'accompagnateur' '$nompersonnel' a été supprimé avec succèss");
//        }
    }

    public function createporteur(Request $request, Experimentation $experimentation)
    {
        if (Gate::denies('create-users')) {
            return redirect()->route('goExperimentation');
        }
        $etablissement = DB::table('etablissement as et')->select(
            'et.ETABCode as ETABCode',
            'et.ETABNom as ETABNom'


        )
            ->leftjoin('experimentation as ex', 'ex.ETABCode', '=', 'et.ETABCode')
            ->where('ex.EXPCode',"=",$experimentation->EXPCode)
            ->first();

        //ddd($etablissement);
        $porteurs=Porteur::all();



        return view('experimentationCreatePorteur', compact('experimentation','etablissement','porteurs'));
    }

    public function storeporteur(Request $request)
    {
        try{








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


        $etabcode=$request->input('ETABCode');

        foreach (DB::table('porteur')->latest('PORTCode')->limit(3)->get() as $e) {
            if ($e->ETABCode == $etabcode) {
                $res4 = DB::table('accompagnement1')->insert([

                    'EXPCode' => $request->input('EXPCode') ,
                    'PORTCode' => $e->PORTCode,
                ]);
            }


        }



        return back()->with("successAjout", "Le(s) porteur(s) de projet ont été ajoutés avec succès ");
        } catch (QueryException $q) {
            return back()->with("successAjout", "Le(s) porteur(s) de projet ont été ajoutés avec succès ");
        }

    }

    public function createpersonnelacad(Request $request, Experimentation $experimentation)
    {
        if (Gate::denies('create-users')) {
            return redirect()->route('goExperimentation');
        }

        $personnelacads=Personnelacad::all();
        $etablissement = DB::table('etablissement as et')->select(
            'et.ETABCode as ETABCode',
            'et.ETABNom as ETABNom'


        )
            ->leftjoin('experimentation as ex', 'ex.ETABCode', '=', 'et.ETABCode')
            ->where('ex.EXPCode',"=",$experimentation->EXPCode)
            ->first();

        //ddd($etablissement);



        return view('experimentationCreatePersonnelacad', compact('experimentation','etablissement','personnelacads'));
    }

    public function storepersonnelacad(Request $request)
    {


        try{

        if (null !== $request->input('PANom0')) {
            $res4 = DB::table('accompagnement2')->insert([

                'EXPCode' => $request->input('EXPCode'),
                'PACode' => $request->input('PANom0')
            ]);
        }

        if (null !== $request->input('PANom1')) {
            $res4 = DB::table('accompagnement2')->insert([

                'EXPCode' => $request->input('EXPCode'),
                'PACode' => $request->input('PANom1')
            ]);
        }

        if (null !== $request->input('PANom2')) {
            $res4 = DB::table('accompagnement2')->insert([

                'EXPCode' => $request->input('EXPCode'),
                'PACode' => $request->input('PANom2')
            ]);
        }




        return back()->with("successAjout", "Les accompagnateur(s) de projet ont été ajoutés avec succès ");
        } catch (QueryException $q) {
            return back()->with("successAjout", "Les accompagnateur(s) de projet ont été ajoutés avec succès ");
        }

    }

    public function createdocument(Request $request, Experimentation $experimentation)
    {
        if (Gate::denies('create-users')) {
            return redirect()->route('goExperimentation');
        }


        $etablissement = DB::table('etablissement as et')->select(
            'et.ETABCode as ETABCode',
            'et.ETABNom as ETABNom'


        )
            ->leftjoin('experimentation as ex', 'ex.ETABCode', '=', 'et.ETABCode')
            ->where('ex.EXPCode',"=",$experimentation->EXPCode)
            ->first();

        //ddd($etablissement);



        return view('experimentationCreateDocument', compact('experimentation','etablissement'));
    }

    public function storedocument(Request $request)
    {


            $res4 = $res = DB::table('experimentation')->where('EXPCode', '=', $request->input('EXPCode'))
                ->update([
                    'ContratACLien'=>$request->input('ContratACLien'),
                    'LivretACLien'=>$request->input('LivretACLien'),
                    'EXPDernierDocLien'=>$request->input('EXPDernierDocLien'),
                    'EXPDernierDocDate'=>$request->input('EXPDernierDocDate')

            ]);

        $experimentations = DB::table('experimentation as ex')->select(
            'e.ETABCode as etabID',
            'ex.EXPCode as EXPCode'

        )
            ->leftjoin('etablissement as e', 'ex.ETABCode', '=', 'e.ETABCode')
            ->where('ex.EXPCode','=', $request->input('EXPCode'))
            ->first();

        //ddd((string)$experimentations->EXPCode);









        return back()->with("successAjout", "Le(s) document(s) ont été modifiés avec succès ");

    }

    public function deletethematique(Experimentation $experimentation, Thematique $thematique){

        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goExperimentation');
        }



        $nomEXP = $thematique->THEMALibelle;

        $res10 = DB::table('thematique_abordee')->where('THEMACode', '=', $thematique->THEMACode)->where('EXPCode', '=', $experimentation->EXPCode)->delete();

        return back()->with("successDelete", "La thématique'' '$nomEXP' a été supprimé avec succèss");
    }

}
