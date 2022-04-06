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
                    {{ __($experimentation->EXPTitre) }}
                </h2>
            </x-slot>

            <div class="py-12" margin="auto" width="10%">
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


                            <form method="get" action="{{route('goExperimentationAffichage',['experimentation'=>$experimentation->EXPCode])}}" position="center">

                                <main role="main" class="container card h-100 justify-content-center">
                                    <div class="justify-content-center">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 blog-main">
                                                <br>

                                                <center>
                                                    <i>Informations de l'expérimentation</i>
                                                </center>

                                                <br>

                                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                                    <tr>
                                                        <th scope="row" class="pt-3-half">Titre de l'expérimentation</th>
                                                        <td class="pt-3-half"> <strong> {{$experimentation->EXPTitre}} </strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half">Date de début de l'expérimentation</th>
                                                        <td class="pt-3-half"> {{$experimentation->EXPDateDebut}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Palier actuel de l'expérimentation</th>
                                                        <td class="blog-post-title">{{$palier->PALLibelle}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half">Thématique(s) de l'expérimentation</th>
                                                        <td class="blog-post-title">@foreach($thematiques as $thematique) {{$thematique->THEMALibelle}} - @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Lien du drive </th>
                                                        <td class="blog-post-title"> <a class="card-text mb-auto" href="{{$experimentation->EXPLienDrive}}">{{$experimentation->EXPLienDrive}}</a></td>
                                                    </tr>
                                                </table>

                                                <br>

                                                <center>
                                                    <i>Informations de l'établissement</i>
                                                </center>

                                                <br>

                                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Etablissement concerné </th>
                                                        <td class="pt-3-half"> <strong> {{$type->TYPNom}} {{$etablissement->ETABNom}} </strong> - {{$etablissement->ETABAdresse}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Mail de l'établissement </th>
                                                        <td class="blog-post-title">{{$etablissement->ETABMail}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Région de l'établissement </th>
                                                        <td class="blog-post-title">{{$territoire->TERRNom}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Ville de l'établissement </th>
                                                        <td class="blog-post-title">{{$ville->VILNom}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Type d'établissement </th>
                                                        <td class="blog-post-title">{{$type->TYPNom}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="pt-3-half"> Chef d'établissement </th>
                                                        <td class="blog-post-title">{{$etablissement->ETABChef}}</td>
                                                    </tr>


                                                </table>


                                                <h3 class="pb-3 mb-4 font-italic border-bottom">

                                                    <br>

                                                    <center>
                                                        <i>Informations de(s) porteur(s) de projet</i>
                                                    </center>

                                                    <br>

                                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center"> Porteur de projet </th>
                                                                <th class="text-center"> Mail du porteur </th>
                                                                <th class="text-center"> Téléphone du porteur </th>
                                                                <th class="text-center"> Etablissement du porteur </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($porteurs as $porteur)

                                                            <tr>
                                                                <td class="pt-3-half"> {{$porteur->PORTNom}} </td>
                                                                <td class="pt-3-half"> {{$porteur->PORTMail}} </td>
                                                                <td class="pt-3-half"> {{$porteur->PORTTel}} </td>
                                                                <td class="pt-3-half"> {{$porteur->ETABCode}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </h3>

                                                <h3 class="pb-3 mb-4 font-italic border-bottom">

                                                    <br>

                                                    <center>
                                                        <i>Informations de(s) accompagnateur(s) de projet</i>
                                                    </center>

                                                    <br>

                                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center"> Accompagnateur de projet </th>
                                                                <th class="text-center"> Mail de l'accompagnateur </th>
                                                                <th class="text-center"> Téléphone de l'accompagnateur </'th>
                                                                <th class="text-center"> Etablissement de l'accompagnateur </'th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($personnelacads as $personnelacad)

                                                            <tr>
                                                                <td class="pt-3-half"> {{$personnelacad->PAPrenom}} {{$personnelacad->PANom}} </td>
                                                                <td class="pt-3-half"> {{$personnelacad->PAMail}} </td>
                                                                <td class="pt-3-half"> {{$personnelacad->PATel}} </td>
                                                                <td class="pt-3-half"> {{$personnelacad->ETABCode}} </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </h3>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <td><br><a class="btn btn-light text-primary" href="{{route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">
                                                            Modifier

                                                        </a></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cet experience ?')){document.getElementById('{{$experimentation->EXPCode}}').submit() }">
                                                            Supprimer

                                                        </a>
                                                        <form id="{{$experimentation->EXPCode}}" action="{{route('goExperimentationSupprimer',['experimentation'=>$experimentation->EXPCode])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete">
                                                        </form>

                                                    </td>
                                                </div><br>

                                                <div class="flex-center position-ref -full-height">

                                                    <br>

                                                    <center>
                                                        <i>Emplacement de l'établissement</i>
                                                    </center>

                                                    <br>

                                                    <div class="map" id="app">
                                                        <gmap-map :center="{lat:45.764043,lng:4.835659}" :zoom="8" style="width: 100%; height: 350px;">

                                                            <gmap-info-window :options="infoWindowOptions" :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}" @closeclick="infoWindowOpened=false">

                                                                <div class="info-window">
                                                                    <h2>{{$etablissement->ETABNom}}</h2>
                                                                    <h5>{{$etablissement->ETABMail}}</h5>
                                                                    <h5>{{$etablissement->ETABTel}}</h5>
                                                                    <h5><a href="{{route('goEtablissementAffichage', ['etablissement'=>$etablissement->ETABCode])}}">Voir plus </a></h5>

                                                                </div>

                                                            </gmap-info-window>

                                                            <gmap-marker :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}" :clickable="true" :draggable="false" @click="infoWindowOpened = true"></gmap-marker>

                                                        </gmap-map>
                                                        <br>
                                                        <a id="id3" class="btn btn-secondary btn-sm" href="{{route("goExperimentationPDF", ['experimentation'=>$experimentation->EXPCode])}}">Telecharger en PDF</a>


                                                    </div>

                                                </div>
                                                <script src="{{mix('js/app.js')}}"></script>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </x-app-layout>
    </div>
</body>
