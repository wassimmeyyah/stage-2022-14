<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/personnelacad.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Les accompagnateurs recherchés') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="d-flex justify-content-between">
                                @include('partials.search3')
                                <p align="center">
                                    <a class="btn btn-light text-primary "  href="{{route('goPersonnelacadAjouter')}}">
                                        Ajouter une personne

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
                            <h6>{{$personnelacad->count()}} résultat(s) pour la recherche </h6>
                            <br>
                            @endif


                            <div class="card-deck">
                                @foreach($personnelacad as $personnelacads)

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                                            <div class="card-body d-flex flex-column align-items-start">

                                                <h3 class="mb-0">
                                                    <a class="text-dark" href="#">{{$personnelacads->PANom}}</a>
                                                </h3>
                                                <div class="mb-1 text-muted"> {{$personnelacads->PAPrenom}}</div>
                                                <p class="card-text mb-auto">Adresse Mail : {{$personnelacads->PAMail}}</p>
                                                <div class="mb-1 text-muted"> {{$personnelacads->PADiscipline}}</div>
                                                <p class="card-text mb-auto">{{$personnelacads->PATel}}</p>

                                                <td><a href="{{route('goPersonnelacadAffichage', ['personnelacad'=>$personnelacads->PACode])}}"><i class="bi bi-arrow-right-circle"> Voir plus </i> </a></td><br>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <td><a class="btn btn-light text-primary"  href="{{route('goPersonnelacadModifier', ['personnelacad'=>$personnelacads->PACode])}}">
                                                            Modifier

                                                        </a></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger"  onclick="if(confirm('Voulez-vous vraiment supprimer ce personnelacad ?')){document.getElementById('{{$personnelacads->PACode}}').submit() }">
                                                            Supprimer

                                                        </a>
                                                        <form id="{{$personnelacads->PACode}}" action="{{route('goPersonnelacadSupprimer',['personnelacad'=>$personnelacads->PACode])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete">
                                                        </form>

                                                    </td>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                @endforeach

                            </div>
                        </div>
                        <div class="container">
                            <a  class="btn btn-secondary " href="{{route('goPersonnelacad')}}">Revenir au personnel</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>
