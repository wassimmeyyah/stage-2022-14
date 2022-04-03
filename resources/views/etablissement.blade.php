<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

@can('read-users')
<div class="container">
    @include('layouts.navigation')
    <div class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les etablissements</h3>
    </div>


    <div class="d-flex justify-content-between">
        {{$etablissements->links()}}
        <form action="{{route('goEtablissementSearch')}}" class=" d-flex mr-3">
            <div class="form-group mb-0 mr-1">
                <input type="text" name="q" class="form-control" value="{{request()->q ?? ''}}">
            </div>
            <button type="submit" class="btn btn-primary mb-3  "><i class="bi bi-search"></i></button>

        </form>
        <p align="center">
            @can('create-users')
            <a class="btn btn-primary " type="button" href="{{route('goEtablissementAjouter')}}">
                Ajouter un etablissement
            </a>
            @endcan
        </p>


    </div>



    @include('partials.filtre')



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
        @foreach($etablissements as $etablissement)
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                    <div class="card-body d-flex flex-column align-items-start">

                        <h3 class="mb-0">
                            <a class="text-dark" href="#">{{$etablissement->ETABNom}}</a>
                        </h3>
                        <div class="mb-1 text-muted"> Numero RNE : {{$etablissement->getKey()}}</div>
                        <p class="card-text mb-auto">Adresse Mail de l'etablissement : {{$etablissement->ETABMail}}</p>

                        <td><a href="{{route('goEtablissementAffichage', ['etablissement'=>$etablissement->ETABCode])}}">Voir plus </a></td><br>

                        <div class="btn-group" role="group" aria-label="Basic example">
                            @can('updateDelete-users')
                            <td><br><a class="btn btn-primary class=pull-left" type="button" href="{{route('goEtablissementModifier', ['etablissement'=>$etablissement->ETABCode])}}">Modifier</a></td>
                            @endcan

                            @can('updateDelete-users')
                            <td><a href="#" class="btn btn-light text-primary class=pull-right" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer cet etablissement ?')){document.getElementById('{{$etablissement->ETABCode}}').submit() }">Supprimer</a>
                                <form id="{{$etablissement->ETABCode}}" action="{{route('goEtablissementSupprimer',['etablissement'=>$etablissement->ETABCode])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                </form>
                            </td>
                            @endcan
                        </div>



                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@else
    @include("attente")
@endcan