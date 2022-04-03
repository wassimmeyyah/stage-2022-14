<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('index', compact('user'));
    }

    public function  show(Request $request){

        if(isset($request->Recherche)) {
            $searchValue = $request->Recherche;
            $user = \App\Models\User::where('id','LIKE', $searchValue . '%')->get();
        }else {
            $users = \App\Models\User::where('name', '!=', 'admin')->orderBy("id","asc")->paginate(5);
        }

        return view("user", ["users" => $users]);}

    public function edit(User $user) {
        $roles = Role::all();
        return view('userUpdate', [
            'user'=>$user,
            'roles'=>$roles
    ]);
    }

    public function update(Request $request, User $user) {
        $user->roles()->sync($request->roles);

        return redirect()->route('goUser');
    }

    public function delete(User $user) {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('goUser');
    }
}
