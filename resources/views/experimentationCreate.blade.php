<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!-- Inclusion des feuilles de styles et script pour le composant Bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


<div class="card-header">
    Ajouter une experimentation
</div>

<div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="container">
    <form method="post" action="{{ route('goExperimentationAjouter') }}">
        @csrf

        <div class="form-row">
            <div class="form-row col-md-6">
                <label for="EXPTitre">Nom de l'experience</label>
                <input type="text" class="form-control" name="EXPTitre" />
            </div>
            <div class="form-row col-md-6">
                <label for="EXPLienInternet">Lien Internet de l'experience</label>
                <input type="text" class="form-control" name="EXPLienInternet" />
            </div>
        </div>
        <div class="form-group">
            <label for="EXPLienDrive">Lien drive de l'experience</label>
            <input type="text" class="form-control" name="EXPLienDrive" />
        </div>
        <div class="form-group">
            <label for="EXPDateDebut">Date du debut de l'experience</label>
            <input type="text" class="form-control" name="EXPDateDebut" />
        </div><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ETABNom">Etablissement de l'experience </label>
                <input type="text" class="form-control" name="ETABNom" />
            </div>
            <div class="form-group col-md-3">
                <label for="ETABCode">RNE de l'etablissement </label>
                <input type="text" class="form-control" name="ETABCode" />
            </div>
            <div class="form-group col-md-3">
                <label for="PALCode">Palier de l'experience </label>
                <select class="form-control" name="PALCode">
                    <option value=""></option>
                    @foreach($paliers as $palier)
                    <option value="{{$palier->PALCode}}">{{$palier->PALLibelle}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="ETABMail">Mail de l'etablissement </label>
                <input type="text" class="form-control" name="ETABMail" />
            </div>
            <div class="form-group col-md-4">
                <label for="ETABChef">Chef de l'etablissement </label>
                <input type="text" class="form-control" name="ETABChef" />
            </div>
            <div class="form-group col-md-3">
                <label for="ETABTel">Telephone de l'etablissement </label>
                <input type="text" class="form-control" name="ETABTel" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="ETABAdresse">Adresse de l'etablissement </label>
                <input type="text" class="form-control" name="ETABAdresse" />
            </div>
            <div class="form-group col-md-3">
                <label for="TERRCode">Departement </label>
                <select class="form-control" name="TERRCode">
                    <option value=""></option>
                    @foreach($territoires as $territoire)
                    <option value="{{$territoire->TERRCode}}">{{$territoire->TERRNom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="VILCode">Ville :</label>
                <select class="form-control" name="VILCode">
                    <option value=""></option>
                    @foreach($villes as $ville)
                    <option value="{{$ville->VILCode}}">{{$ville->VILNom}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="TYPCode">Type de l'etablissement </label>
                <select class="form-control" name="TYPCode">
                    <option value=""></option>
                    @foreach($types as $type)
                    <option value="{{$type->TYPCode}}">{{$type->TYPNom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="SPECode">Specialite de l'etablissement </label>
                <select class="form-control" name="SPECode">
                    <option value=""></option>
                    @foreach($specialites as $specialite)
                    <option value="{{$specialite->SPECode}}">{{$specialite->SPENom}}</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="group-form" name="add_thematique" id="add_thematique">
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_fieldTH">
                    <tr>
                        <td>
                            <label for="THEMALibelle0"> Thématique : </label>
                            <select class="form-control" name="THEMALibelle0">
                                <option value=""></option> @foreach($thematiques as $thematique) <option value="{{$thematique->THEMACode}}">{{$thematique->THEMALibelle}}</option> @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" name="addTH" id="addTH" class="btn btn-primary">Ajouter une thématique</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                var i = 0;
                $('#addTH').click(function() {
                    i++;
                    if (i < 11) {
                        $('#dynamic_fieldTH').append('<tr id="row' + i + '"><td><select class="form-control" name="THEMALibelle' + i + '"> <option value=""></option> @foreach($thematiques as $thematique) <option value="{{$thematique->THEMACode}}">{{$thematique->THEMALibelle}}</option> @endforeach </select></td><td><button type="button" name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
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
                        data: $('#add_thematique').serialize(),
                        success: function(data) {
                            alert(data);
                            $('#add_thematique')[0].reset();
                        }
                    });
                });
            });
        </script>

        <div class="form-group" name="add_porteur" id="add_porteur">
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td>
                            <label for="PORTNom">Nom du porteur </label>
                            <input type="text" name="PORTNom0" placeholder="Entrez le nom du porteur..." class="form-control name_list">
                        </td>
                        <td>
                            <label for="PORTMail">Mail du porteur </label>
                            <input type="text" name="PORTMail0" placeholder="Entrez le mail du porteur ..." class="form-control name_list">
                        </td>
                        <td>
                            <label for="PORTTel">Numéro de téléphone du porteur</label>
                            <input type="text" name="PORTTel0" placeholder="Entrez le téléphone du porteur ..." class="form-control name_list">
                        </td>

                        <td>
                            <button type="button" name="add" id="add" class="btn btn-primary">Ajouter un porteur</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                var i = 0;
                $('#add').click(function() {
                    i++;
                    if (i < 3) {
                        $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="PORTNom' + i + '" placeholder="Entrez le nom du porteur ..." class="form-control name_list" /></td><td><input type="text" name="PORTMail' + i + '" placeholder="Entrez le mail du porteur ..." class="form-control name_list" /></td><td><input type="text" name="PORTTel' + i + '" placeholder="Entrez le téléphone du porteur ..." class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
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
                            <label for="PANom0">Nom de l'accompagnateur </label>
                            <select class="form-control" name="PANom0">
                                <option value=""></option> @foreach($personnelacads as $personnelacad) <option value="{{$personnelacad->PACode}}">{{$personnelacad->PANom}}</option> @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" name="addAP" id="addAP" class="btn btn-primary">Ajouter un accompagnateur</button>
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
                    if (i < 3) {
                        $('#dynamic_fieldAP').append('<tr id="row' + i + '"><td><select class="form-control" name="PANom' + i + '"> <option value=""></option> @foreach($personnelacads as $personnelacad) <option value="{{$personnelacad->PACode}}">{{$personnelacad->PANom}}</option> @endforeach </select></td><td><button type="button" name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
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
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Ajouter l'expérimentation</button>
            <a class="btn btn-light text-primary" href="{{route('goExperimentation')}}">Annuler</a>
        </div>
    </form>
</div>