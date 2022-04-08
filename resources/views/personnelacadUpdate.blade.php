<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/personnelacad.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('Modification') }} :  {{ __($personnelacad->PANom) }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif

                            <form method="post" action="{{ route('goPersonnelacadModifier', ['personnelacad'=>$personnelacad->PACode])}}">
                                . @csrf

                                <input type="hidden" name="_method" value="put">

                                <div class="form-group">
                                    <label for="PACode">Identifiant de la personne :</label>
                                    <input readonly type="text" class="form-control" name="PACode" value="{{$personnelacad->PACode}}" />
                                </div>

                                <div class="form-group">
                                    <label for="PANom">Nom de la personne :</label>
                                    <input type="text" class="form-control" name="PANom" value="{{$personnelacad->PANom}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PAPrenom">Prénom de la personne :</label>
                                    <input type="text" class="form-control" name="PAPrenom" value="{{$personnelacad->PAPrenom}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PAMail">Adresse Mail de la personne :</label>
                                    <input type="text" class="form-control" name="PAMail" value="{{$personnelacad->PAMail}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PADiscipline">Discipline enseignée par la personne :</label>
                                    <input type="text" class="form-control" name="PADiscipline" value="{{$personnelacad->PADiscipline}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PAAdressePerso">Adresse de la personne :</label>
                                    <input type="text" class="form-control" name="PAAdressePerso" value="{{$personnelacad->PAAdressePerso}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PATel">Téléphone de la personne :</label>
                                    <input type="text" class="form-control" name="PATel" value="{{$personnelacad->PATel}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PAFonction">Fonction de la personne :</label>
                                    <input type="text" class="form-control" name="PAFonction" value="{{$personnelacad->PAFonction}}" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABCode">Numero RNE de l'etablissement de la personne :</label>
                                    <input readonly type="text" class="form-control" name="ETABCode" value="{{$personnelacad->ETABCode}}" />
                                </div>
                                <button  class="btn btn-light text-primary">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>
