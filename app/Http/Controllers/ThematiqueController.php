<?php

namespace App\Http\Controllers;

use App\Models\Thematique;
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

        $res = DB::table('thematique')->insert([

            'THEMACode' => $_POST['THEMACode'],
            'THEMALibelle' => $_POST['THEMALibelle']
        ]);


        return redirect('/experimentation')->with("successAjout", "la thématique' '$request->THEMALibelle'a été ajoutée avec succès");
    }
}
