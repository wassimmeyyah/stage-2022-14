<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

@can('read-users')

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Les porteurs') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="d-flex justify-content-between">
                                {{$porteurs->links()}}
                                @include('partials.search2')
                                <div class="btn-group">
                                    <p align="center">
                                        <a class="btn btn-danger "  href="{{route('goPorteurMail')}}">Contacts des personnes</a>
                                        @can('create-users')
                                        <a class="btn btn-light text-primary "  href="{{route('goPorteurAjouter')}}">
                                            Ajouter un porteur
                                        </a>
                                        @endcan
                                    </p>
                                </div>

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
                                @foreach($porteurs as $porteur)

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                                            <div class="card-body d-flex flex-column align-items-start">

                                                <h3 class="mb-0">
                                                    <a class="text-dark" href="#">{{$porteur->PORTNom}}</a>
                                                </h3>
                                                <div class="mb-1 text-muted"> Numero de telephone : {{$porteur->PORTTel}}</div>
                                                <p class="card-text mb-auto">Adresse Mail : {{$porteur->PORTMail}}</p>

                                                <td><a href="{{route('goPorteurAffichage', ['porteur'=>$porteur->PORTCode])}}"><i class="bi bi-arrow-right-circle"> Voir plus </i> </a></td><br>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @can('updateDelete-users')
                                                    <td><br><a class="btn btn-light text-primary"  href="{{route('goPorteurModifier', ['porteur'=>$porteur->PORTCode])}}">
                                                            Modifier
                                                        </a></td>
                                                    @endcan
                                                    @can('updateDelete-users')
                                                    <td>
                                                        <a href="#" class="btn btn-danger"  onclick="if(confirm('Voulez-vous vraiment supprimer ce porteur ?')){document.getElementById('{{$porteur->PORTCode}}').submit() }">
                                                            Supprimer
                                                        </a>
                                                        <form id="{{$porteur->PORTCode}}" action="{{route('goPorteurSupprimer',['porteur'=>$porteur->PORTCode])}}" method="post">
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