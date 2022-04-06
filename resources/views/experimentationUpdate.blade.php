<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Modification') }} : {{ __($experimentation->EXPTitre) }}
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

                            <form method="post" action="{{ route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">
                                . @csrf

                                <input type="hidden" name="_method" value="put">

                                <div class="form-group">
                                    <label for="EXPCode">Code l'experimentation :</label>
                                    <input readonly type="text" class="form-control" name="EXPCode" value="{{$experimentation->EXPCode}}" />
                                </div>

                                <div class="form-group">
                                    <label for="EXPTitre">Titre de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPTitre" value="{{$experimentation->EXPTitre}}" />
                                </div>
                                <div class="form-group">
                                    <label for="EXPLienInternet">Lien Internet de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPLienInternet" value="{{$experimentation->EXPLienInternet}}" />
                                </div>
                                <div class="form-group">
                                    <label for="EXPLienDrive">Lien Drive de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPLienDrive" value="{{$experimentation->EXPLienDrive}}" />
                                </div>
                                <div class="form-group">
                                    <label for="EXPDateDebut">Date du debut de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPDateDebut" value="{{$experimentation->EXPDateDebut}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ETABCode">Etablissement de l'experimentation:</label>
                                    <select class="form-control" name="ETABCode">
                                        <option value=""></option>
                                        @foreach($etablissements as $etablissement)
                                        @if($etablissement->ETABCode == $experimentation->ETABCode)
                                        <option value="{{$etablissement->ETABCode}}" selected>{{$etablissement->ETABNom}}</option>
                                        @else
                                        <option value="{{$etablissement->ETABCode}}">{{$etablissement->ETABNom}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="PALCode">Palier de l'experimentation :</label>
                                    <select class="form-control" name="PALCode">
                                        <option value=""></option>
                                        @foreach($paliers as $palier)
                                        @if($palier->PALCode == $experimentation->PALCode)
                                        <option value="{{$palier->PALCode}}" selected>{{$palier->PALNom}}</option>
                                        @else
                                        <option value="{{$palier->PALCode}}">{{$palier->PALNom}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <button  class="btn btn-light text-primary">Modifier</button>
                                <a class="btn btn-danger" href="{{route('goExperimentation')}}">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>
