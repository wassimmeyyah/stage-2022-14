<!-- Accueil -->

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>


<tbody>
<div class="container">

    <div  class="card " style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Application Academie de Lyon </h3>
    </div>
    <div  class="card" style="text-align: center;">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 p-3 mb-2 bg-light text-primary">Accueil</h3>
    </div>

    <div class="card-group">
        <div class="card" style="width: 18rem;">
            <img src="/Image/imageExp.png" class="card-img-top" alt="/Image/imageExp.png">
            <div class="card-body">
                <p class="card-text">
                <p align="center">
                    <a class="favorite styled text-primary text-uppercase" type="button" href="{{route('goExperimentation2')}}">
                        Les expérimentations
                    </a>
                </p></p>
            </div>
        </div>
        <div class="card" align="center" style="width: 18rem;">
            <img src="/Image/imageEtab.png" class="card-img-top" alt="/Image/imageEtab.png">
            <div class="card-body">
                <p class="card-text">
                <p align="center">
                    <a class="favorite styled text-primary text-uppercase" type="button" href="{{route('goEtablissement2')}}">
                        Les etablissements
                    </a>
                </p></p>
            </div>
        </div>
        <div class="card" align="center" style="width: 18rem;">
            <img src="/Image/imagePort.png" class="card-img-top" alt="/Image/imagePort.png">
            <div class="card-body">
                <p class="card-text">
                <p align="center">
                    <a class="favorite styled text-primary text-uppercase" type="button" href="{{route('goPorteur2')}}">
                        Les porteurs de projet
                    </a>
                </p></p>
            </div>
        </div>
        <div class="card" align="center" style="width: 18rem;">
            <img src="/Image/imagePers.jpg" class="card-img-top" alt="/Image/imagePers.jpg">
            <div class="card-body">
                <p class="card-text">
                <p align="center">
                    <a class="favorite styled text-primary text-uppercase" type="button" href="{{route('goPersonnelacad2')}}">
                        Le personnel académique
                    </a>
                </p></p>
            </div>
        </div>
        <div class="card" align="center" style="width: 18rem;">
            <img src="/Image/imageCarte.png" class="card-img-top" alt="/Image/imageCarte.png">
            <div class="card-body">
                <p class="card-text">
                <p align="center">
                    <a class="favorite styled text-primary text-uppercase" type="button" href="{{route('goCarte')}}">
                        La cartographie
                    </a>
                </p></p>
            </div>
        </div>

    </div>
</div>


</tbody>
