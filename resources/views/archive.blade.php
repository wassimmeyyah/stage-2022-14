<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!-- Inclusion des feuilles de styles et script pour le composant Bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
@can('read-users')
<div class="container">
    @include('layouts.navigation')
    <div class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les archives</h3>
    </div>
    <div class="d-flex justify-content-between">
        {{$archives->links()}}
        <p align="center">
            @can('manage-users')
            <a class="btn btn-light text-primary " type="button" href="{{route('goThematiqueAjouter')}}">
                Ajouter une thématique
            </a>
            @endcan
            @can('create-users')
            <a class="btn btn-light text-primary " type="button" href="{{route('goArchiveAjouter')}}">
                Ajouter une archive
            </a>
            @endcan
        </p>


    </div>



    <form action="" class=" d-flex mr-3">
        <div class="form-group mr-3 d-flex justify-content-end p-2">
            <label for="filtreType">Filtrer par région </label>
            <select name="q" id="filtreType" wire:model="filtreType" style="min-width:110px;">
                <option name="q" class="form-control" value=""></option>
                <option name="q" class="form-control" value="RHO">Rhône</option>
                <option name="q" class="form-control" value="LOI">Loire</option>
                <option name="q" class="form-control" value="AIN">Ain</option>
            </select>


        </div>
        <div class="form-group mr-3 d-flex justify-content-end p-2">
            <label for="filtreRegion">Filtrer par type </label>
            <select name="p" id="filtreRegion" wire:model="filtreRegion" style="min-width:110px;">
                <option name="p" class="form-control" value=""></option>
                <option name="p" class="form-control" value="ECL">Ecole</option>
                <option name="p" class="form-control" value="CLG">College</option>
                <option name="p" class="form-control" value="LYC">Lycée</option>
            </select>
        </div>

        <div class="form-group mr-3 d-flex justify-content-end p-2">
            <label for="filtreRegion">Filtrer par thematique</label>

            <select id="THEMACode" class="selectpicker " multiple data-live-search="true" name="THEMACode">
                <option value=""></option>
                @foreach($thematiques as $thematique)
                <option value="{{$thematique->THEMACode}}">{{$thematique->THEMALibelle}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-light text-primary"><i class="bi bi-funnel"></i></button>



    </form>




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
        @foreach($archives as $archive)

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                    <div class="card-body d-flex flex-column align-items-start">

                        <h3 class="mb-0">
                            <a class="text-dark" href="#">{{$archive->EXPTitre}}</a>
                        </h3>
                        <div class="mb-1 text-muted">Date de debut {{$archive->EXPDateDebut}}</div>
                        <p class="card-text mb-auto">Lien du drive : </p><a class="card-text mb-auto" href="{{$archive->EXPLienDrive}}">{{$archive->EXPLienDrive}}</a><br>

                        <td><a href="{{route('goArchiveAffichage', ['archive'=>$archive->EXPCode])}}">Voir plus </a></td><br>

                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
</div>
@else
@include("attente")
@endcan