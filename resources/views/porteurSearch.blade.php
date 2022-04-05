<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>

<div class="container">
    @include('layouts.navigation')
    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les porteurs</h3>
    </div>
    <div class="d-flex justify-content-between">
        @include('partials.search2')
        <p align="center">
            <a class="btn btn-light text-primary " type="button" href="{{route('goPorteurAjouter')}}">
                Ajouter un porteur

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
        <h6>{{$porteur->count()}} résultat(s) pour la recherche </h6>
        <br>
    @endif

    <div class="card-deck">
        @foreach($porteur as $porteurs)

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250" style="width: 204%">
                        <div class="card-body d-flex flex-column align-items-start">

                            <h3 class="mb-0">
                                <a class="text-dark" href="#">{{$porteurs->PORTNom}}</a>
                            </h3>
                            <div class="mb-1 text-muted"> Numero de telephone : {{$porteurs->PORTTel}}</div>
                            <p class="card-text mb-auto">Adresse Mail : {{$porteurs->PORTMail}}</p>

                            <td><a href="{{route('goPorteurAffichage', ['porteur'=>$porteurs->PORTCode])}}">Voir plus </a></td><br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <td><br><a class="btn btn-light text-primary" type="button" href="{{route('goPorteurModifier', ['porteur'=>$porteurs->PORTCode])}}">
                                    Modifier

                                </a></td>
                            <td>
                                <a  href="#" class="btn btn-danger" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer ce porteur ?')){document.getElementById('{{$porteurs->PORTCode}}').submit() }" >
                                    Supprimer

                                </a>
                                <form id="{{$porteurs->PORTCode}}" action="{{route('goPorteurSupprimer',['porteur'=>$porteurs->PORTCode])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                </form>

                            </td></div>
                        </div>
                        </div>
                </div>


            </div>

        @endforeach

    </div>
</div>
<div class="container">
    <a type="button" class="btn btn-secondary " href="{{route('goPorteur')}}">Revenir aux porteurs</a><br>
</div>



