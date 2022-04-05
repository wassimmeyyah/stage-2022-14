<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Ajouter une thématique') }}
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


                            <form method="post" action="{{ route('goThematiqueAjouter') }}">
                                @csrf


                                <div class="form-group">
                                    <label for="THEMACode">Code de la thématique :</label>
                                    <input type="text" class="form-control" name="THEMACode" />
                                </div>
                                <div class="form-group">
                                    <label for="THEMALibelle">Description de la thématique :</label>
                                    <input type="text" class="form-control" name="THEMALibelle" />
                                </div>

                                <br>
                                <button  class="btn btn-light text-primary">Ajouter</button>
                                <a class="btn btn-danger" href="{{route('goExperimentation')}}">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>
