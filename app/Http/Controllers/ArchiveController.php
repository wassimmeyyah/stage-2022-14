<?php

namespace App\Http\Controllers;

use App\Models\Accompagnement;
use App\Models\Archive;
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


class ArchiveController extends Controller
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
            $archives = \App\Models\Archive::where('EXPCode', 'LIKE', $searchValue . '%')->get();
        } else {
            $archives = \App\Models\Archive::orderBy("EXPCode", "asc")->paginate(10);
        }

        return view("archive", ["archives" => $archives], compact('etablissements', 'groupethematiques', 'thematiques', 'paliers', 'porteurs', 'personnelacads', 'territoires', 'types', 'specialites', 'villes'));
    }

    public function index()
    {
        $archive = Archive::all();

        return view('index', compact('archive'));
    }

}
