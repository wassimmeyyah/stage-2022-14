<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<form action="{{route('goEtablissementFiltre')}}" class=" d-flex mr-3">
    <div class="form-group mr-3 d-flex justify-content-end p-2">
        <label for="filtreType">Filtrer par région </label>
        <select name="q" id="filtreType" wire:model="filtreType" style="min-width:110px;">
            <option name="q" class="form-control" value=""></option>
            <option name="q" class="form-control" value="RHO">Rhône</option>
            <option name="q" class="form-control" value="LOI">Loire</option>
            <option name="q" class="form-control" value="AIN">Ain</option>
        </select>


    </div>
    <div class="form-group mr-3 d-flex justify-content-end p-2">
        <label for="filtreRegion">Filtrer par type </label>
        <select name ="p" id="filtreRegion" wire:model="filtreRegion" style="min-width:110px;">
            <option name="p" class="form-control" value=""></option>
            <option name="p" class="form-control" value="ECL">Ecole</option>
            <option name="p" class="form-control" value="CLG">College</option>
            <option name="p" class="form-control" value="LYC">Lycée</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i></button>



</form>

