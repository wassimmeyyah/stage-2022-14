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
                {{ __('Ajouter un ou des accompagnateurs de projet') }}
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


                        <form method="post" action="{{ route('goExperimentationAjouterPersonnelacad', ['experimentation'=>$experimentation->EXPCode]) }}">
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
                                <label for="ETABCode">Numero RNE de l'etablissement</label>
                                <input readonly type="text" class="form-control" name="ETABCode"   value="{{$etablissement->ETABCode}}"/>
                            </div>


                            <div class="form-group" name="add_personnelacad" id="add_personnelacad">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field">

                                        <tr>
                                            <td>
                                                <label for="PANom">Nom accompagnateur </label>
                                                <input type="text" name="PANom2" placeholder="Entrez le nom de l'accompagnateur..." class="form-control name_list">
                                            </td>
                                            <td>
                                                <label for="PAMail">Mail accompagnateur </label>
                                                <input type="text" name="PAMail2" placeholder="Entrez le mail de l'accompagnateur ..." class="form-control name_list">
                                            </td>
                                            <td>
                                                <label for="PATel">Numéro téléphone</label>
                                                <input type="text" name="PATel2" placeholder="Entrez le téléphone de l'accompagnateur ..." class="form-control name_list">
                                            </td>
                                            <td>
                                                <label for="PADiscipline">Discipline</label>
                                                <input type="text" name="PADiscipline2" placeholder="Entrez la discipline de l'accompagnateur ..." class="form-control name_list">
                                            </td>
                                            <td>
                                                <label for="PAFonction">Fonction</label>
                                                <input type="text" name="PAFonction2" placeholder="Entrez la fonction de l'accompagnateur ..." class="form-control name_list">
                                            </td>

                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-light text-primary">Ajouter un accompagnateur</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var i = 2;
                                    $('#add').click(function() {
                                        i++;
                                        if (i < 4) {
                                            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="PANom' + i + '" placeholder="Entrez le nom de l accompagnateur ..." class="form-control name_list" /></td><td><input type="text" name="PAMail' + i + '" placeholder="Entrez le mail de l accompagnateur ..." class="form-control name_list" /></td><td><input type="text" name="PATel' + i + '" placeholder="Entrez le téléphone de l accompagnateur ..." class="form-control name_list" /></td><td><input type="text" name="PADiscipline' + i + '" placeholder="Entrez la discipline de l accompagnateur ..." class="form-control name_list" /></td><td><input type="text" name="PAFonction' + i + '" placeholder="Entrez la fonction de l accompagnateur ..." class="form-control name_list" /></td><td><button name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
                                        }
                                    });
                                    $(document).on('click', '.btn_remove', function() {
                                        var button_id = $(this).attr('id');
                                        $('#row' + button_id + '').remove();
                                    });
                                    $('submit').click(function() {
                                        $.ajax({
                                            url: "back.php",
                                            method: "POST",
                                            data: $('#add_porteur').serialize(),
                                            success: function(data) {
                                                alert(data);
                                                $('#add_porteur')[0].reset();
                                            }
                                        });
                                    });
                                });
                            </script>

                            <div class="group-form" name="add_personnelacad" id="add_personnelacad">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_fieldAP">
                                        <tr>
                                            <td>
                                                <label for="PANom0">Ajouter un ou des accompagnateurs déjà existants </label>
                                                <select class="form-control" name="PANom0">
                                                    <option value=""></option> @foreach($personnelacads as $personnelacad) <option value="{{$personnelacad->PACode}}">{{$personnelacad->PANom}}</option> @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" name="addAP" id="addAP" class="btn btn-light text-primary">Ajouter un accompagnateur</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    var i = 0;
                                    $('#addAP').click(function() {
                                        i++;
                                        if (i < 2) {
                                            $('#dynamic_fieldAP').append('<tr id="row' + i + '"><td><select class="form-control" name="PANom' + i + '"> <option value=""></option> @foreach($personnelacads as $personnelacad) <option value="{{$personnelacad->PACode}}">{{$personnelacad->PANom}}</option> @endforeach </select></td><td><button  name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
                                        }
                                    });
                                    $(document).on('click', '.btn_remove', function() {
                                        var button_id = $(this).attr('id');
                                        $('#row' + button_id + '').remove();
                                    });
                                    $('submit').click(function() {
                                        $.ajax({
                                            url: "back.php",
                                            method: "POST",
                                            data: $('#add_personnelacad').serialize(),
                                            success: function(data) {
                                                alert(data);
                                                $('#add_personnelacad')[0].reset();
                                            }
                                        });
                                    });
                                });
                            </script>

                            <div class="btn-group">
                                <button name="submit" id="submit" class="btn btn-light text-primary">Ajouter</button>
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
