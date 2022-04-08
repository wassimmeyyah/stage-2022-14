<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

@can('read-users')


<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('La carte') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex-center position-ref -full-height">
                                <div class="content">

                                    <div class="map" id="app">
                                        <gmap-map :center="{lat:45.399269104003906,lng:4.366680145263672}" :zoom="8" style="width: 100%; height: 700px;">
                                            @foreach($coordonnees as $coordonnee)

                                            <gmap-info-window
                                                options="width: 0, height: -35"

                                                @closeclick="false"

                                            >
                                                <div class="info-window">
                                                    <h2>{{$coordonnee->ETABNom}}</h2>
                                                    <h5>{{$coordonnee->ETABCode}}</h5>
                                                    <h5><a href="{{route('goEtablissementAffichage', ['etablissement'=>$coordonnee->ETABCode])}}">Voir plus </a></h5>

                                                </div>

                                            </gmap-info-window>
                                            <gmap-marker
                                                :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}"
                                                :clickable="true"
                                                :draggable="false"
                                                @click ="marker"></gmap-marker>
                                            @endforeach

                                        </gmap-map>

                                        <script>
                                            const marker = new google.maps.Marker({
                                                position: {lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}},
                                                map,
                                                title: "",
                                            });

                                            marker.addListener("click", () => {
                                                infowindow.open({
                                                    anchor: marker,
                                                    map,
                                                    shouldFocus: false,
                                                });
                                            });
                                        </script>



                                    </div>
                                </div>
                            </div>
                            <script src="{{mix('js/app.js')}}"></script>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>



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




</div>
</div>
@else
@include("attente")
@endcan
