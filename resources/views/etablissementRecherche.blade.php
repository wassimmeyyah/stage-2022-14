<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>

<div class="container">
    @include('layouts.navigation')
    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Les etablissements</h3>
    </div>

    <div style="height:175px;display:block;"> </div>
    <body class="text-center">

    <img class="mb-4" src="/Image/imageEtab.png" class="card-img-top" alt="/Image/imageEtab.png" width="125" height="125">
    <form action="{{route('goEtablissementRecherche')}}" class="form-signin" >



        <input type="text" name="q" class="form-signin"  value="{{request()->q ?? ''}}">

        <button type="submit" class="btn btn-primary mb-3  "><i class="bi bi-search">  Rechercher un etablissment  </i></button>


    </form>

    <a type="button" class="btn btn-light text-primary " href="{{route('goEtablissement')}}">Afficher tous les etablissements</a>


    </body>
    <div style="height:250px;display:block;"> </div>
</div>
