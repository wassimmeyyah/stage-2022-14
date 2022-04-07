<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
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
                                @if(session()->has("successDelete"))
                                    <div class="alert alert-success">
                                        <h3>{{session()->get('successDelete')}}</h3>
                                    </div>
                                @endif

                            <form method="post" action="{{ route('goExperimentationModifier', ['experimentation'=>$experimentation->EXPCode])}}">
                                 @csrf

                                <input type="hidden" name="_method" value="put">



                                <div class="form-group">
                                    <label for="EXPTitre">Titre de l'experimentation :</label>
                                    <input readonly type="text" class="form-control" name="EXPTitre" value="{{$experimentation->EXPTitre}}" />
                                </div>
                                <div class="form-group">
                                    <label for="ETABCode">Etablissement de l'experimentation:</label>
                                    <input readonly type="text" class="form-control" name="ETABNom"   value="{{$etablissement->ETABNom}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="EXPDateDebut">Date du debut de l'experimentation :</label>
                                    <input readonly type="text" class="form-control" name="EXPDateDebut" value="{{$experimentation->EXPDateDebut}}" />
                                </div>
                                <div class="form-group">
                                    <label for="PALCode">Palier de l'experimentation :</label>
                                    <select  class="form-control" name="PALCode">
                                        <option value=""></option>
                                        @foreach($paliers as $palier)
                                            @if($palier->PALCode == $experimentation->PALCode)
                                                <option value="{{$palier->PALCode}}" selected>{{$palier->PALLibelle}}</option>
                                            @else
                                                <option value="{{$palier->PALCode}}">{{$palier->PALLibelle}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">Thématiques de l'experimentation déjà existante :</label><br>

                                        @foreach($thematiques as $thematique)

                                            <input readonly type="text" class="form-control" name="THEMACode" value="{{$thematique->THEMALibelle}}" />


                                        @endforeach


                                </div>
                                <br>

                                <div class="group-form" name="add_thematique" id="add_thematique">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_fieldTH">
                                            <tr>
                                                <td>
                                                    <label for="THEMALibelle0"> Thématique : </label>
                                                    <select class="form-control" name="THEMALibelle0">
                                                        <option value=""></option> @foreach($thems as $them) <option value="{{$them->THEMACode}}">{{$them->THEMALibelle}}</option> @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" name="addTH" id="addTH" class="btn btn-light text-primary">Ajouter une thématique</button>
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
                                            if (i < 5) {
                                                $('#dynamic_fieldTH').append('<tr id="row' + i + '"><td><select class="form-control" name="THEMALibelle' + i + '"> <option value=""></option> @foreach($thems as $them) <option value="{{$them->THEMACode}}">{{$them->THEMALibelle}}</option> @endforeach </select></td><td><button  name="remove" id="' + i + '"class="btn btn-danger btn_remove">X</button></td></tr>');
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

                                <div class="form-group">
                                    <label for="EXPLienInternet">Lien Internet de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPLienInternet" value="{{$experimentation->EXPLienInternet}}" />
                                </div>
                                <div class="form-group">
                                    <label for="EXPLienDrive">Lien Drive de l'experimentation :</label>
                                    <input type="text" class="form-control" name="EXPLienDrive" value="{{$experimentation->EXPLienDrive}}" />
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
