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
                    {{ __('Ajouter un établissement') }}
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
                            @if(session()->has("echecAjout"))
                            <div class="alert alert-danger">
                                <h3>{{session()->get('echecAjout')}}</h3>
                            </div>
                            @endif



                            <form method="post" action="{{ route('goEtablissementAjouter') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="ETABCode">Numero RNE de l'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABCode" />
                                </div>

                                <div class="form-group">
                                    <label for="ETABNom">Nom de l'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABNom" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABMail">Adresse Mail de l'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABMail" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABChef">Nom du chef d'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABChef" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABAdresse">Adresse de l'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABAdresse" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABTel">Telephone de l'etablissement :</label>
                                    <input type="text" class="form-control" name="ETABTel" />
                                </div>

                                <div class="form-group">
                                    <label for="TERRCode">Departement :</label>
                                    <select class="form-control" name="TERRCode">
                                        <option value=""></option>
                                        @foreach($territoires as $territoire)
                                        <option value="{{$territoire->TERRCode}}">{{$territoire->TERRNom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="TYPCode">Type de l'etablissement :</label>
                                    <select class="form-control" name="TYPCode">
                                        <option value=""></option>
                                        @foreach($types as $type)
                                        <option value="{{$type->TYPCode}}">{{$type->TYPNom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SPECode">Spécialité de l'etablissement :</label>
                                    <select class="form-control" name="SPECode">
                                        <option value=""></option>
                                        @foreach($specialites as $specialite)
                                        <option value="{{$specialite->SPECode}}">{{$specialite->SPENom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="VILCode">Ville de l'etablissement :</label>
                                    <select class="form-control" name="VILCode">
                                        <option value=""></option>
                                        @foreach($villes as $ville)
                                        <option value="{{$ville->VILCode}}">{{$ville->VILNom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <button class="btn btn-light text-primary">Ajouter</button>
                                <a class="btn btn-danger" href="{{route('goEtablissement')}}">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>