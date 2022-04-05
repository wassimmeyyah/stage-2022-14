<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __($porteur->PORTNom) }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif


                            <form method="get" action="{{route('goPorteurAffichage',['porteur'=>$porteur->PORTCode])}}">


                                <main role="main" class="container">
                                    <div class="row">
                                        <div class="col-md-8 blog-main">
                                            <h3 class="pb-3 mb-4 font-italic border-bottom">
                                                {{$porteur->PORTNom}}
                                            </h3>

                                            <div class="blog-post">
                                                <h2 class="blog-post-title">{{$porteur->PORTMail}}</h2>
                                                <p class="blog-post-meta">{{$porteur->PORTTel}}<a href="#">Appeler</a></p>
                                                <p>Le porteur provient de l'etablissement <a href="{{route('goEtablissementAffichage', ['etablissement'=>$porteur->ETABCode])}}">{{$etablissement->ETABNom}}</a> L'etablissement est situé dans la region du {{$territoire->TERRNom}} et dans la ville de {{$ville->VILNom}}. Il s'agit d'un etablissement de type {{$type->TYPNom}} et de specialité {{$specialite->SPENom}}

                                                </p>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <td><br><a class="btn btn-light text-primary"  href="{{route('goPorteurModifier', ['porteur'=>$porteur->PORTCode])}}">
                                                            Modifier

                                                        </a></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger"  onclick="if(confirm('Voulez-vous vraiment supprimer ce porteur ?')){document.getElementById('{{$porteur->PORTCode}}').submit() }">
                                                            Supprimer

                                                        </a>
                                                        <form id="{{$porteur->PORTCode}}" action="{{route('goPorteurSupprimer',['porteur'=>$porteur->PORTCode])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete">
                                                        </form>

                                                    </td>
                                                </div><br>
                                                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" src="/Image/imageacad2.jpg" width="320" height="220" alt="/Image/imageacad2.jpg">
                                                <hr>
                                                <a  id="id3" class="btn btn-secondary btn-sm" href="{{route("goPorteurPDF", ['porteur'=>$porteur->PORTCode])}}">Telecharger en PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>