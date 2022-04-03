<!-- create.blade.php -->



<head>
        <meta charset="UTF-8">
        <!-- si on veut lier à un fichier css -->
        <link rel="stylesheet" type="text/css" href="../../html/css/personnelacad.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    </head>

    <div class="card uper">
        <div class="card-header">
            Ajouter une personne
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


            <form method="post" action="{{ route('goPersonnelacadAjouter') }}">
                         @csrf


                <div class="form-group">
                    <label for="PANom">Nom de la personne :</label>
                    <input type="text" class="form-control" name="PANom"/>
                </div>
                <div class="form-group">
                    <label for="PAPrenom">Prénom de la personne :</label>
                    <input type="text" class="form-control" name="PAPrenom"/>
                </div>
                <div class="form-group">
                    <label for="PAMail">Adresse Mail de la personne :</label>
                    <input type="text" class="form-control" name="PAMail"/>
                </div>
                <div class="form-group">
                    <label for="PADiscipline">Discipline enseignée par la personne :</label>
                    <input type="text" class="form-control" name="PADiscipline"/>
                </div>
                <div class="form-group">
                    <label for="PAAdressePerso">Adresse de la personne : :</label>
                    <input type="text" class="form-control" name="PAAdressePerso"/>
                </div>
                <div class="form-group">
                    <label for="PATel">Téléphone de la personne :</label>
                    <input type="text" class="form-control" name="PATel"/>
                </div>
                <div class="form-group">
                    <label for="PAAdresse">Numero RNE de l'etablissement de la personne :</label>
                    <input type="text" class="form-control" name="ETABCode"/>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a class="btn btn-light text-danger" href="{{route('goPersonnelacad')}}">Annuler</a>
            </form>
        </div>
    </div>

