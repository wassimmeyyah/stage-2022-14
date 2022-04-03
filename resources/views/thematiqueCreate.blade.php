<!-- create.blade.php -->



<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/porteur.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="card uper">
    <div class="card-header">
        Ajouter une thématique
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

            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a class="btn btn-light text-danger" href="{{route('goExperimentation')}}">Annuler</a>
        </form>
    </div>
</div>