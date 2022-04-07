<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!-- Inclusion des feuilles de styles et script pour le composant Bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
<div class="container">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('Ajouter un porteur de projet') }}
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
                            @if(session()->has("successAjout"))
                                <div class="alert alert-success">
                                    <h3>{{session()->get('successAjout')}}</h3>
                                </div>
                            @endif


                        <form method="post" action="{{ route('goExperimentationAjouterDocument', ['experimentation'=>$experimentation->EXPCode]) }}">
                            @csrf

                            <div class="form-group">
                                <label for="EXPCode">Titre de l'experimentation :</label>
                                <input readonly type="text" class="form-control" name="EXPCode" value="{{$experimentation->EXPCode}}" />
                            </div>

                            <div class="form-group">
                                <label for="EXPTitre">Numero de l'experimentation :</label>
                                <input readonly type="text" class="form-control" name="EXPTitre" value="{{$experimentation->EXPTitre}}" />
                            </div>

                            <div class="form-group">
                                <label for="ETABNom">Etablissement de l'experimentation:</label>
                                <input readonly type="text" class="form-control" name="ETABNom"   value="{{$etablissement->ETABNom}}"/>
                            </div>
                            <div class="form-group">
                                <label for="ContratACLien">Lien vers le Contrat d'accompagnement</label>
                                <input  type="text" class="form-control" name="ContratACLien"  placeholder="{{$experimentation->ContratACLien}}" value="{{$experimentation->ContratACLien}}"/>
                            </div>
                            <div class="form-group">
                                <label for="LivretACLien">Lien vers le Livret d'accompagnement</label>
                                <input  type="text" class="form-control" name="LivretACLien" placeholder="{{$experimentation->LivretACLien}}"  value="{{$experimentation->LivretACLien}}"/>
                            </div>
                            <div class="form-group">
                                <label for="EXPDernierDocLien">Lien vers le Dernier document de suivi </label>
                                <input  type="text" class="form-control" name="EXPDernierDocLien"  placeholder="{{$experimentation->EXPDernierDocLien}}" value="{{$experimentation->EXPDernierDocLien}}"/>
                            </div>
                            <div class="form-group">
                                <label for="EXPDernierDocDate">Date du dernier document de suivi </label>
                                <input  type="text" class="form-control" name="EXPDernierDocDate" {{$experimentation->EXPDernierDocDate}}placeholder="{{$experimentation->EXPDernierDocDate}}"  value="{{$experimentation->EXPDernierDocDate}}"/>
                            </div>




                            <div class="btn-group">
                                <button name="submit" id="submit" class="btn btn-light text-primary">Modifier</button>
                                <a class="btn btn-danger" href="{{route('goExperimentationAffichage',['experimentation'=>$experimentation->EXPCode])}}">Revenir à l'experimentation</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
</body>
