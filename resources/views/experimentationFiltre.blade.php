<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Les expérimentations filtrées') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="d-flex justify-content-between">

                                @include('partials.search4')
                                <p align="center">
                                    <a class="btn btn-light text-primary " href="{{route('goExperimentationAjouter')}}">
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
                            @if(request()->input())
                            <h6>{{$experimentation->count()}} résultat(s) pour la recherche </h6>
                            @endif
                            <br>

                            <div class="card-deck">
                                @foreach($experimentation as $experimentations)

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                                            <div class="card-body d-flex flex-column align-items-start">

                                                <h3 class="mb-0">
                                                    <a class="text-dark" href="#">{{$experimentations->EXPTitre}}</a>
                                                </h3>
                                                <div class="mb-1 text-muted">Date de debut {{$experimentations->EXPDateDebut}}</div>
                                                <p class="card-text mb-auto">Lien du drive : </p><a class="card-text mb-auto" href="{{$experimentations->EXPLienDrive}}">{{$experimentations->EXPLienDrive}}</a><br>

                                                <td><a href="{{route('goExperimentationAffichage', ['experimentation'=>$experimentations->expID])}}">Voir plus </a></td><br>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if($experimentations->EXPArchivage == 0)
                                                    <td><br><a class="btn btn-light text-primary class=pull-left" href="{{route('goExperimentationArchiver', ['experimentation'=>$experimentations->EXPCode])}}">Archiver</a></td>
                                                    @endif
                                                    @can('manage-users')
                                                    <td><a href="#" class="btn btn-danger class=pull-right" onclick="if(confirm('Voulez-vous vraiment supprimer cet etablissement ?')){document.getElementById('{{$experimentations->expID}}').submit() }">Supprimer</a>
                                                        <form id="{{$experimentations->expID}}" action="{{route('goExperimentationSupprimer',['experimentation'=>$experimentations->expID])}}" method="post">
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
                    <a class="btn btn-secondary " href="{{route('goExperimentation')}}">Revenir aux experimentations</a><br>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>