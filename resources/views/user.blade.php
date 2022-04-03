<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/user.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="container">

    @include('layouts.navigation')
    <div class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les utilisateurs</h3>
    </div>
    <div class="d-flex justify-content-between">
        {{$users->links()}}
        @include('partials.search2')
    </div>

    @if(session()->has("successDelete"))
    <div class="alert alert-success">
        <h3>{{session()->get('successDelete')}}</h3>
    </div>
    @endif
    @if(session()->has("successAjout"))
    <div class="alert alert-success">
        <h3>{{session()->get('successAjout')}}</h3>
    </div>
    @endif
    @if(session()->has("successModify"))
    <div class="alert alert-success">
        <h3>{{session()->get('successModify')}}</h3>
    </div>
    @endif

    <div id="table" class="table-editable bg-light">
        <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
        @if(session()->has('successDelete'))
        <div class="alert alert-success">
            <h3>{{session()->get('successDelete')}}</h3>
        </div>
        @endif
        <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center"> Nom de l'utilisateur</th>
                    <th class="text-center"> Adresse mail de l'utilisateur</th>
                    <th class="text-center"> Rôle(s) de l'utilisateur</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="pt-3-half"> {{$user->name}} </td>
                    <td class="pt-3-half"> {{$user->email}} </td>
                    <td class="pt-3-half"> {{ implode(', ', $user->roles()->get()->pluck('name')->toArray() )}} </td> </td>
                    @can('manage-users')
                    <td><a class="btn btn-primary" type="button" href="{{route('goUserModifier', $user->id)}}">
                            Modifier
                        </a></td>
                    <td>
                        @endcan
                        @can('manage-users')
                        <td>
                                <a href="#" class="btn btn-light text-primary" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer cet utilisateur ?')){document.getElementById('{{$user->id}}').submit() }">
                                    Supprimer
                                </a>
                                <form id="{{$user->id}}" action="{{route('goUserSupprimer',['user'=>$user->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                </form>
                            </td>
                        @endcan
                        
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>