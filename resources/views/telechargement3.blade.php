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
                {{$personnelacad->PANom}} {{$personnelacad->PAPrenom}}
            </h3>

            <div class="blog-post">
                <h2 class="blog-post-title">{{$personnelacad->PAMail}}</h2>
                <p class="blog-post-meta">{{$personnelacad->PATel}}<a href="#">Appeler</a></p>
                <p>Ce membre de l'académie provient de l'etablissement {{$personnelacad->ETABCode}}. Le membre est spécialisé en {{$personnelacad->PADiscipline}}.

                </p>



                <p> </p>

                <hr>

            </div>
        </div>
    </div>
</main>
