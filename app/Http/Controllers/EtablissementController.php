<?php

namespace App\Http\Controllers;

use pdf;
use App\Models\Type;
use App\Models\Ville;
use App\Models\Porteur;
use App\Models\Coordonnee;
use App\Models\Specialite;

use App\Models\Territoire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class EtablissementController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function  show(Request $request)
    {
       $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom", "asc")->paginate(10);
        //return view("etablissement", ["etablissements" => $etablissements]);


        return view("etablissement", ["etablissements" => $etablissements]);
    }

    public function  show2(Request $request)
    {

        $etablissements = Etablissement::where('ETABCode', '!=', 'Aucun')->orderBy("ETABNom", "asc")->get();
        $coordonnees = DB::table('coordonnees as c')->select(
            'c.COORDCode as COORDCode',
            'c.COORDLatitude as COORDLatitude',
            'c.COORDLongitude as COORDLongitude',
            'e.ETABCode as ETABCode',
            'e.ETABNom as ETABNom',
            'e.ETABNom as ETABMAil'
        )


            ->leftjoin('etablissement as e', 'e.COORDCode', '=', 'c.COORDCode')->distinct()
            ->get();

         // ddd($coordonnees);


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
        if (Gate::denies('create-users')) {
            return redirect()->route('goEtablissement');
        }

        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        return view('etablissementCreate', compact('territoires', 'types', 'specialites', 'villes'));
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
        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        try{

            $res = DB::table('coordonnees')->insert([
                'COORDLatitudeLongitude' => "45.74837173982651, 4.83702637056378",
                'COORDLatitude' => "45.74837173982651",
                'COORDLongitude' => "4.83702637056378"
            ]);

            //ddd(DB::table('coordonnees')->latest('COORDCode')->limit(1)->first()->COORDCode);


            $res2 = DB::table('ville')->insert([
                'VILNom' => $request->input('VILCode'),
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
                'VILCode' => DB::table('ville')->latest('VILCode')->limit(1)->first()->VILCode,
                'COORDCode' => DB::table('coordonnees')->latest('COORDCode')->limit(1)->first()->COORDCode
            ]);



            return redirect('/etablissement')->with("successAjout", "l'etablissement' '$request->ETABNom'a été ajouté avec succès");

            }
                    catch(QueryException $q){
              return redirect('/etablissement/ajouter')->with("echecAjout", "Veuillez saisir un numero RNE qui n'existe pas déja");
            }

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
            return redirect()->route('goEtablissement');
        }

        $territoires = Territoire::all();
        $types = Type::all();
        $specialites  = Specialite::all();
        $villes = Ville::all();

        $etablissement = Etablissement::findOrFail($id);

        $coordonnees = DB::table('coordonnees as c')->select(
            'c.COORDCode as COORDCode',
            'c.COORDLatitude as COORDLatitude',
            'c.COORDLongitude as COORDLongitude',
            'e.ETABCode'
        )




            ->leftjoin('etablissement as e', 'e.COORDCode', '=', 'c.COORDCode')

            ->where('e.ETABCode', $id)
            ->first();

        $ville = DB::table('ville as v')->select(
            'v.VIlCode',
            'v.VILNom as VILNom'
        )
            ->leftjoin('etablissement as e', 'e.VILCode', '=', 'v.VILCode')

            ->where('e.ETABCode', $id)
            ->first();

        //ddd($coordonnees->COORDLatitude);

        return view('etablissementUpdate', compact("etablissement", 'territoires', 'types', 'specialites', 'villes','coordonnees','ville'));
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



        $res = DB::table('coordonnees')->where('COORDCode', '=', $etablissement->COORDCode)
            ->update([


                'COORDLatitude' => $request->input('COORDLatitude'),
                'COORDLongitude' => $request->input('COORDLongitude')
            ]);

            $res2 = DB::table('ville')->insert([
                'VILNom' => $request->input('VILCode'),
            ]);

            $res = DB::table('etablissement')->where('ETABCode', '=', $etablissement->ETABCode)
                ->update([
                'ETABNom' => $request->input('ETABNom'),
                'ETABMail' => $request->input('ETABMail'),
                'ETABChef' => $request->input('ETABChef'),
                'ETABAdresse' => $request->input('ETABAdresse'),
                'ETABTel' => $request->input('ETABTel'),
                'TERRCode' => $request->input('TERRCode'),
                'TYPCode' => $request->input('TYPCode'),
                'SPECode' => $request->input('SPECode'),
                    'VILCode' => DB::table('ville')->latest('VILCode')->limit(1)->first()->VILCode,
            ]);



        return redirect('/etablissement')->with("successModify", "L'etablissement' '$request->ETABNom' a été mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Etablissement $etablissement)
    {
        if (Gate::denies('updateDelete-users')) {
            return redirect()->route('goEtablissement');
        }

        $nometab = $etablissement->ETABNom;
        $etablissement->delete();

        return back()->with("successDelete", "L'etablissement' '$nometab' a été supprimé avec succèss");
    }

    public function search()
    {
        $q = request()->input('q');


        $etablissements2 = Etablissement::where('ETABCode', 'like', "%$q%")
            ->orWhere('ETABNom', 'like', "%$q%")
            ->orWhere('ETABMail', 'like', "%$q%")
            ->orWhere('ETABChef', 'like', "%$q%")
            ->orWhere('ETABAdresse', 'like', "%$q%")
            ->orWhere('ETABTel', 'like', "%$q%")
            ->orWhere('TERRCode', 'like', "%$q%")
            ->orWhere('TYPCode', 'like', "%$q%")
            ->orWhere('SPECode', 'like', "%$q%")
            ->orWhere('VILCode', 'like', "%$q%")
            ->orderBy("ETABNom", "asc")
            ->get();

        $etablissements = $etablissements2->where('ETABCode', '!=', "Aucun");

        return view('etablissementSearch')->with('etablissement', $etablissements);
    }

    public function recherche()
    {
        $q = request()->input('q');
        $etablissements2 = Etablissement::where('ETABCode', 'like', "%$q%")
            ->orWhere('ETABNom', 'like', "%$q%")
            ->orWhere('ETABMail', 'like', "%$q%")
            ->orWhere('ETABChef', 'like', "%$q%")
            ->orWhere('ETABAdresse', 'like', "%$q%")
            ->orWhere('ETABTel', 'like', "%$q%")
            ->orWhere('TERRCode', 'like', "%$q%")
            ->orWhere('TYPCode', 'like', "%$q%")
            ->orWhere('SPECode', 'like', "%$q%")
            ->orWhere('VILCode', 'like', "%$q%")
            ->orderBy("ETABNom", "asc")
            ->get();

        $etablissements = $etablissements2->where('ETABCode', '!=', "Aucun");

        return view('etablissementSearch')->with('etablissement', $etablissements);
    }

    public function affiche($id2)
    {

        $etablissement = Etablissement::find($id2);
        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();
        $coordonnee = Coordonnee::where('COORDCode', $etablissement->COORDCode)->first();




        return view("etablissementAffichage", compact("etablissement", 'territoire', 'type', 'specialite', 'ville', 'coordonnee'));
    }


    public function filtre()
    {
        $q = request()->input('q');
        $p = request()->input('p');
        $etablissements2 = Etablissement::Where('TERRCode', 'LIKE', "%$q%")
            ->Where('TYPCode', 'LIKE', "%$p%")
            ->orderBy("ETABNom", "asc")
            ->get();

        $etablissements = $etablissements2->where('ETABCode', '!=', "Aucun");

        return view('etablissementFiltre')->with('etablissement', $etablissements);
    }

    public function telechargerPdf($id3)
    {

        $etablissement = Etablissement::findOrFail($id3);
        $territoire = Territoire::where('TERRCode', $etablissement->TERRCode)->first();
        $type = Type::where('TYPCode', $etablissement->TYPCode)->first();
        $specialite  = Specialite::where('SPECode', $etablissement->SPECode)->first();
        $ville = Ville::where('VILCode', $etablissement->VILCode)->first();

        $pdf = FacadePdf::loadView('telechargement1', compact('etablissement', 'territoire', 'type', 'specialite', 'ville'));
        return $pdf->download('Synthèse - établissement.pdf');
    }



    public function fake()
    {
        // $etablissement = Etablissement::where('ETABCode', "=", "0690791K")->get();
        $etablissement = Etablissement::find('0690791K');
        // ddd($etablissement);
        $porteur = $etablissement->porteur;
        // $porteur = Porteur::where('PORTCode', '=', '1')->get();


        // $porteur = $etablissement->porteur();

         //ddd($porteur);

        // foreach($porteur as $p) {
        //     echo $p->PORTNom . "<br>";
        // }

        $porteur = Porteur::find(1);

        $etablissement = $porteur->etablissement;

        ddd($etablissement);

    }
}
