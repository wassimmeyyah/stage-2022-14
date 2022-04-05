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

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Les expérimentations') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="d-flex justify-content-between">
                                {{$experimentations->links()}}
                                @include('partials.search4')
                                <p align="center">
                                    @can('manage-users')
                                    <a class="btn btn-light text-primary " href="{{route('goThematiqueAjouter')}}">
                                        Ajouter une thématique
                                    </a>
                                    @endcan
                                    @can('create-users')
                                    <a class="btn btn-light text-primary " href="{{route('goExperimentationAjouter')}}">
                                        Ajouter une experimentation
                                    </a>
                                    @endcan
                                </p>


                            </div>

                            <form action="{{route('goExperimentationFiltre')}}" class=" d-flex mr-3">

                                <!-- <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Afficher les expérimentations archivées</label>
        </div> -->


                                <div class="form-group mr-3 d-flex justify-content-end p-2">
                                    <label for="filtreArchivage"> Archives : </label>
                                    <select name="r" id="filtreType" wire:model="filtreType" style="min-width:110px;">
                                        <option name="r" class="form-control" value=""></option>
                                        <option name="r" class="form-control" value="0">En cours</option>
                                        <option name="r" class="form-control" value="1">Archivés</option>
                                    </select>
                                </div>

                                <div class="form-group mr-3 d-flex justify-content-end p-2">
                                    <label for="filtreType">Filtrer par région : </label>
                                    <select name="q" id="filtreType" wire:model="filtreType" style="min-width:110px;">
                                        <option name="q" class="form-control" value=""></option>
                                        <option name="q" class="form-control" value="RHO">Rhône</option>
                                        <option name="q" class="form-control" value="LOI">Loire</option>
                                        <option name="q" class="form-control" value="AIN">Ain</option>
                                    </select>


                                </div>
                                <div class="form-group mr-3 d-flex justify-content-end p-2">
                                    <label for="filtreRegion">Filtrer par type : </label>
                                    <select name="p" id="filtreRegion" wire:model="filtreRegion" style="min-width:110px;">
                                        <option name="p" class="form-control" value=""></option>
                                        <option name="p" class="form-control" value="ECL">Ecole</option>
                                        <option name="p" class="form-control" value="CLG">College</option>
                                        <option name="p" class="form-control" value="LYC">Lycée</option>
                                    </select>
                                </div>

                                <div class="form-group mr-3 d-flex justify-content-end p-2">
                                    <label for="filtreThematique">Filtrer par thematique :</label>

                                    <select name="s" id="THEMACode" wire:model="filtreRegion" style="min-width:110px;">
                                        <option name="s" class="form-control" value=""></option>
                                        @foreach($thematiques as $thematique)
                                        <option name="s" class="form-control" value="{{$thematique->THEMACode}}">{{$thematique->THEMALibelle}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <button class="btn btn-light text-primary"><i class="bi bi-funnel"></i></button>
                                </div>

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
                                @foreach($experimentations as $experimentation)

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                                            <div class="card-body d-flex flex-column align-items-start">

                                                <h3 class="mb-0">
                                                    <a class="text-dark" href="#">{{$experimentation->EXPTitre}} <br> Etablissement : {{$experimentation->ETABNom}} <br> Departement : {{$experimentation->TERRNom}} </a>
                                                </h3>
                                                <div class="mb-1 text-muted">Date de debut {{$experimentation->EXPDateDebut}}</div>
                                                <p class="card-text mb-auto">Lien du drive : </p><a class="card-text mb-auto" href="{{$experimentation->EXPLienDrive}}">{{$experimentation->EXPLienDrive}}</a><br>

                                                <td><a href="{{route('goExperimentationAffichage', ['experimentation'=>$experimentation->EXPCode])}}">Voir plus </a></td><br>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @can('updateDelete-users')
                                                    <td><br><a class="btn btn-light text-primary class=pull-left" href="{{route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">Modifier</a></td>
                                                    @endcan

                                                    @can('updateDelete-users')
                                                    <td>
                                                        <a href="#" class="btn btn-danger class=pull-right" onclick="if(confirm('Voulez-vous vraiment supprimer cet etablissement ?')){document.getElementById('{{$experimentation->EXPCode}}').submit() }">Supprimer</a>
                                                        <form id="{{$experimentation->EXPCode}}" action="{{route('goExperimentationSupprimer',['experimentation'=>$experimentation->EXPCode])}}" method="post">
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
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>
@else
@include("attente")
@endcan