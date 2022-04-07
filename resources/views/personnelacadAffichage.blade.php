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
                    {{ __($personnelacad->PAPrenom) }} {{ __($personnelacad->PANom)}}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="d-flex justify-content-between">
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

                                </div>

                                <div class="col-md-8 blog-main">
                                    <br>
                                    <h3 class="pb-3 mb-4 font-italic border-bottom justify-content-center">
                                        Accompagnateur : {{$personnelacad->PANom}}
                                    </h3>

                                    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" src="/Image/imageacad2.jpg" width="320" height="220" alt="/Image/imageacad2.jpg">


                                    <br>

                                    <center>
                                        <i>Informations de l'accompagnateur</i>
                                    </center>

                                    <br>

                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                        <tr>
                                            <th scope="row" class="pt-3-half">Nom de l'accompagnateur</th>
                                            <td class="pt-3-half"> <strong> {{$personnelacad->PANom}} {{$personnelacad->PAPrenom}} </strong> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="pt-3-half">Mail de l'accompagnateur</th>
                                            <td class="pt-3-half"> {{$personnelacad->PAMail}} </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="pt-3-half">Numéro de téléphone de l'accompagnateur</th>
                                            <td class="blog-post-title">{{$personnelacad->PATel}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="pt-3-half">Discipline de l'accompagnateur</th>
                                            <td class="blog-post-title">{{$personnelacad->PADiscipline}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="pt-3-half">Etablissement de l'accompagnateur</th>
                                            <td class="blog-post-title">{{$personnelacad->ETABCode}}</td>
                                        </tr>


                                    </table>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <td><br><a class="btn btn-light text-primary" href="{{route('goPersonnelacadModifier', ['personnelacad'=>$personnelacad->PACode])}}"><i class="bi bi-file-earmark-text">
                                                    Modifier les informations de l'accompagnateur

                                                </i></a>
                                        </td>
                                    </div>
                                    <div class="content">

                                    </div>
                                    <br>
                                    <a id="id3" class="btn btn-secondary btn-sm" href="{{route("goPersonnelacadPDF", ['personnelacad'=>$personnelacad->PACode])}}">Telecharger en PDF</a>

                                </div><br>




                            </div>
                        </div>
                    </div>
                </div>
        </x-app-layout>
    </div>
</body>