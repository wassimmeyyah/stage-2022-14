<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>

<body>

<div class="container">
    @include('layouts.navigation')
    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les experimentations</h3>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif


        <form method="get" action="{{route('goExperimentationAffichage',['experimentation'=>$experimentation->EXPCode])}}">


            <main role="main" class="container">
                <div class="row">
                    <div class="col-md-8 blog-main">
                        <h3 class="pb-3 mb-4 font-italic border-bottom">
                            {{$experimentation->EXPTitre}}
                        </h3>

                        <div class="blog-post">
                            <h2 class="blog-post-title">{{$experimentation->EXPDateDebut}}</h2>
                            <p class="blog-post-meta"><a class="card-text mb-auto" href="{{$experimentation->EXPLienDrive}}">{{$experimentation->EXPLienDrive}}</p>
                            <p class="blog-post-meta"><a class="card-text mb-auto" href="{{$experimentation->EXPLienInternet}}">{{$experimentation->EXPLienInternet}}</p>


                            <div class="btn-group" role="group" aria-label="Basic example">
                                <td><br><a class="btn btn-primary" type="button" href="{{route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">
                                        Modifier

                                    </a></td>
                                <td>
                                    <a  href="#" class="btn btn-light text-primary" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer cet experience ?')){document.getElementById('{{$experimentation->EXPCode}}').submit() }" >
                                        Supprimer

                                    </a>
                                    <form id="{{$experimentation->EXPCode}}" action="{{route('goExperimentationSupprimer',['experimentation'=>$experimentation->EXPCode])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                    </form>

                                </td></div><br>
                            <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" src="/Image/imageacad2.jpg" width="320" height="220" alt="/Image/imageacad2.jpg">
                            <hr>

                            <main role="main" class=" card h-100 ">
                                <div class="">
                                    <div class="row ">
                                        <div class="col-md-8 blog-main">
                                            <h3 class="pb-3 mb-4 font-italic border-bottom ">
                                                Etablissement : {{$etablissement->ETABNom}}
                                            </h3>

                            <h2 class="blog-post-title">{{$etablissement->ETABMail}}</h2>
                            <p class="blog-post-meta">{{$etablissement->ETABTel}}<a href="#">Appeler</a></p>
                            <p>Située dans la zone A, l'Académie de Lyon accueille plus de 323 000 élèves pour une population totale de 3 293 813 habitants.
                                Elle totalise 3 365 établissements scolaires ce qui la place au 11ème rang des académies françaises. Elle compte également 419 établissements d'enseignement professionel et post-bac.
                                Pour plus d'informations, vous pouvez consulter le site officiel de l'académie sur http://www.ac-lyon.fr

                            </p>

                            <p>L'etablissement {{$etablissement->ETABNom}} se situe dans la région du {{$territoire->TERRNom}} . Il s'agit d'un etablissement de type {{$type->TYPNom}} et de spécialité {{$specialite->SPENom}}. Son chef d'etablissement est {{$etablissement->ETABChef}}. </p>

                                            <h3 class="pb-3 mb-4 font-italic border-bottom">
                                                {{$porteur->PORTNom}}
                                            </h3>
                    </div>
                </div>
                <body>
                <div class="flex-center position-ref -full-height">
                    <div class="content">
                        <h2>Carte</h2>
                        <div class="map" id="app" >
                            <gmap-map
                                :center="{lat:45.764043,lng:4.835659}"
                                :zoom="8"
                                style="width: 50%; height: 350px;">

                                <gmap-info-window
                                    :options="infoWindowOptions"
                                    :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}"

                                    @closeclick="infoWindowOpened=false"
                                >

                                    <div class="info-window">
                                        <h2>{{$etablissement->ETABNom}}</h2>
                                        <h5>{{$etablissement->ETABMail}}</h5>
                                        <h5>{{$etablissement->ETABTel}}</h5>
                                        <h5><a href="{{route('goEtablissementAffichage', ['etablissement'=>$etablissement->ETABCode])}}">Voir plus </a></h5>

                                    </div>

                                </gmap-info-window>

                                <gmap-marker
                                    :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}"
                                    :clickable="true"
                                    :draggable="false"
                                    @click="infoWindowOpened = true"
                                ></gmap-marker>

                            </gmap-map>

                        </div>
                    </div>
                </div>
                <script src="{{mix('js/app.js')}}"></script>
                </body>
    </div>
    </main>
    </form>
</div>
</form>

                            <a type="submit" id="id3" class="btn btn-secondary btn-sm" href="{{route("goExperimentationPDF", ['experimentation'=>$experimentation->EXPCode])}}">Telecharger en PDF</a>
                        </div>
                    </div>
                </div>
            </main>
        </form>
    </div>
</form>
