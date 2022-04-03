<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />

</head>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Etablissement : {{$etablissement->ETABNom}}
            </h3>

            <div class="blog-post">
                <h2 class="blog-post-title">{{$etablissement->ETABMail}}</h2>
                <p class="blog-post-meta">{{$etablissement->ETABTel}}</p>
                <p>Située dans la zone A, l'Académie de Lyon accueille plus de 323 000 élèves pour une population totale de 3 293 813 habitants.
                    Elle totalise 3 365 établissements scolaires ce qui la place au 11ème rang des académies françaises. Elle compte également 419 établissements d'enseignement professionel et post-bac.
                    Pour plus d'informations, vous pouvez consulter le site officiel de l'académie sur http://www.ac-lyon.fr

                </p>

                <p>L'etablissement {{$etablissement->ETABNom}} se situe dans la région du {{$territoire->TERRNom}} . Il s'agit d'un etablissement de type {{$type->TYPNom}} et de spécialité {{$specialite->SPENom}}. Son chef d'etablissement est {{$etablissement->ETABChef}}. </p>

                <hr>
                <img src="/Image/imageacadlyon.png" alt="">
            </div>
        </div>
    </div>
</main>
