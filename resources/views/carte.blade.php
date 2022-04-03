<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>

@can('read-users')
<div class="container">
    @include('layouts.navigation')
    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">La carte des etablissements</h3>
    </div>

    <body>
    <div class="flex-center position-ref -full-height">
        <div class="content">

            <div class="map" id="app">
                <gmap-map
                    :center="{lat:45.764043,lng:4.835659}"
                    :zoom="8"
                    style="width: 100%; height: 700px;">
                    @foreach($coordonnees as $coordonnee)


                        <gmap-marker
                            :position="{lat:{{$coordonnee->COORDLatitude}},lng:{{$coordonnee->COORDLongitude}}}"
                            :clickable="true"
                            :draggable="false"
                            @click="infoWindowOpened = true"
                        ></gmap-marker>
                    @endforeach

                </gmap-map>

            </div>
        </div>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
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


