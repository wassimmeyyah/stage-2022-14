<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('Modification') }} : {{ __($porteur->PORTNom) }}
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

                            <form method="post" action="{{ route('goPorteurModifier', ['porteur'=>$porteur->PORTCode])}}">
                                . @csrf

                                <input type="hidden" name="_method" value="put">

                                <div class="form-group">
                                    <label for="PORTCode">Identifiant du porteur :</label>
                                    <input readonly type="text" class="form-control" name="PORTCode" value="{{$porteur->PORTCode}}" />
                                </div>

                                <div class="form-group">
                                    <label for="PORTNom">Nom du porteur :</label>
                                    <input type="text" class="form-control" name="PORTNom" value="{{$porteur->PORTNom}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PORTMail">Adresse Mail du porteur :</label>
                                    <input type="text" class="form-control" name="PORTMail" value="{{$porteur->PORTMail}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PORTChef">Téléphone du porteur : :</label>
                                    <input type="text" class="form-control" name="PORTTel" value="{{$porteur->PORTChef}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PORTAdresse">Numero RNE de l'etablissement du porteur :</label>
                                    <input type="text" class="form-control" name="ETABCode" value="{{$porteur->PORTAdresse}}" />
                                </div>
                                <button  class="btn btn-light text-primary">Modifier</button>
                                <a class="btn btn-danger" href="{{route('goPorteur')}}">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>