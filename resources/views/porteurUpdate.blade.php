<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>

<div class="card uper">
    <div class="card-header">
        Modifier un porteur
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

        <form method="post" action="{{ route('goPorteurModifier', ['porteur'=>$porteur->PORTCode])}}">
            .         @csrf

            <input type="hidden" name="_method" value="put">

            <div class="form-group">
                <label for="PORTCode">Identifiant du porteur :</label>
                <input readonly type="text" class="form-control" name="PORTCode" value="{{$porteur->PORTCode}}"/>
            </div>

            <div class="form-group">
                    <label for="PORTNom">Nom du porteur :</label>
                    <input type="text" class="form-control" name="PORTNom" value="{{$porteur->PORTNom}}"/>
                </div>
                <div class="form-group">
                    <label for="PORTMail">Adresse Mail du porteur :</label>
                    <input type="text" class="form-control" name="PORTMail" value="{{$porteur->PORTMail}}"/>
                </div>
                <div class="form-group">
                    <label for="PORTChef">Téléphone du porteur : :</label>
                    <input type="text" class="form-control" name="PORTTel" value="{{$porteur->PORTChef}}"/>
                </div>
                <div class="form-group">
                    <label for="PORTAdresse">Numero RNE de l'etablissement du porteur :</label>
                    <input type="text" class="form-control" name="ETABCode" value="{{$porteur->PORTAdresse}}"/>
                </div>
            <button type="submit" class="btn btn-light text-primary">Modifier</button>
            <a class="btn btn-light text-danger" href="{{route('goEtablissement')}}">Annuler</a>
        </form>
    </div>
</div>
