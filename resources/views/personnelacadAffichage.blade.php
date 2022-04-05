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
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Le personnel academique</h3>
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

        <form method="get" action="{{route('goPersonnelacadAffichage',['personnelacad'=>$personnelacad->PACode])}}">


            <main role="main" class="container">
                <div class="row">
                    <div class="col-md-8 blog-main">
                        <h3 class="pb-3 mb-4 font-italic border-bottom">
                             {{$personnelacad->PANom}} {{$personnelacad->PAPrenom}}
                        </h3>

                        <div class="blog-post">
                            <h2 class="blog-post-title">{{$personnelacad->PAMail}}</h2>
                            <p class="blog-post-meta">{{$personnelacad->PATel}}<a href="#">Appeler</a></p>
                            <p>Ce membre de l'académie provient de l'etablissement {{$personnelacad->ETABCode}}. Le membre est spécialisé en {{$personnelacad->PADiscipline}}.

                            </p>

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <td><a class="btn btn-light text-primary" type="button" href="{{route('goPersonnelacadModifier', ['personnelacad'=>$personnelacad->PACode])}}">
                                        Modifier

                                    </a></td>
                                <td>
                                    <a  href="#" class="btn btn-danger" type="button" onclick="if(confirm('Voulez-vous vraiment supprimer ce personnelacad ?')){document.getElementById('{{$personnelacad->PACode}}').submit() }" >
                                        Supprimer

                                    </a>
                                    <form id="{{$personnelacad->PACode}}" action="{{route('goPersonnelacadSupprimer',['personnelacad'=>$personnelacad->PACode])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                    </form>

                                </td></div><br>
                            <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" src="/Image/imageacad2.jpg" width="320" height="220" alt="/Image/imageacad2.jpg">
                            <hr>
                            <a type="submit" id="id3" class="btn btn-secondary btn-sm" href="{{route("goPersonnelacadPDF", ['personnelacad'=>$personnelacad->PACode])}}">Telecharger en PDF</a>
                        </div>
                    </div>
                </div>
            </main>
        </form>
    </div>
</form>
