<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  bg-light " id="navbarTogglerDemo01">

            <a class="navbar-brand text-uppercase text-primary " href="{{route('goHome')}}">Accueil</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link  text-primary " href="{{route('goExperimentation2')}}">Les experimentations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-primary " href="{{route('goEtablissement2')}}">Les etablissements</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link  text-primary " href="{{route('goPorteur2')}}">Les porteurs </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-primary " href="{{route('goPersonnelacad2')}}">Le personnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-primary " href="{{route('goCarte')}}">La cartographie</a>
                </li>

            </ul>
        </div>
    </nav>
    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les experimentations</h3>
    </div>
    <div class="d-flex justify-content-between">

        @include('partials.search4')
        <p align="center">
            <a class="btn btn-primary " type="button" href="{{route('goExperimentationAjouter')}}">
                Ajouter une experimentation
            </a>
        </p>


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

    <div class="card-deck">
        @foreach($experimentations as $experimentation)

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                        <div class="card-body d-flex flex-column align-items-start">

                            <h3 class="mb-0">
                                <a class="text-dark" href="#">{{$experimentation->EXPTitre}}</a>
                            </h3>
                            <div class="mb-1 text-muted">Date de debut {{$experimentation->EXPDateDebut}}</div>
                            <p class="card-text mb-auto" >Lien du drive : </p><a class="card-text mb-auto" href="{{$experimentation->EXPLienDrive}}">{{$experimentation->EXPLienDrive}}</a><br>

                            <td><a href="{{route('goExperimentationAffichage', ['experimentation'=>$experimentation->EXPCode])}}">Voir plus </a></td><br>

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <td><br><a class="btn btn-primary class=pull-left" type="button" href="{{route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">Modifier</a></td>

                                <td><a href="#" class="btn btn-light text-primary class=pull-right" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer cet etablissement ?')){document.getElementById('{{$experimentation->EXPCode}}').submit() }">Supprimer</a>
                                    <form id="{{$experimentation->EXPCode}}" action="{{route('goExperimentationSupprimer',['experimentation'=>$experimentation->EXPCode])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                </td></div>



                        </div>

                        </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
</div>
<a type="button" class="btn btn-secondary " href="{{route('goExperimentation')}}">Revenir aux experimentations</a><br>
</div>
</div>
