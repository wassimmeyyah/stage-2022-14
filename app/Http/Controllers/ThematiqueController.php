<?php

namespace App\Http\Controllers;

use App\Models\Thematique;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ThematiqueController extends Controller
{
    public function create()
    {
        if(Gate::denies('manage-users') ) {
            return redirect()->route('goThematique');
        }

        return view('thematiqueCreate');
    }


    public function store(Request $request)
    {
        try {
                $res = DB::table('thematique')->insert([

                    'THEMACode' => $request->input('THEMACode'),
                    'THEMALibelle' => $request->input('THEMALibelle')
                ]);


                return redirect('/experimentation')->with("successAjout", "la thématique' '$request->THEMALibelle'a été ajoutée avec succès");
            }catch(QueryException $q){

            return redirect('/thematique/ajouter')->with("echecAjout", "Veuillez saisir un nouveau code thematique different. Celui-ci existe déja !");

        }
    }
}
