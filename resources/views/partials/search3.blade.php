<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<form action="{{route('goPersonnelacadSearch')}}" class=" d-flex mr-3">
    <div class="form-group mb-0 mr-1">
        <input type="text" name="q" class="form-control" value="{{request()->q ?? ''}}">
    </div>
    <button type="submit" class="btn btn-primary mb-3  "><i class="bi bi-search"></i></button>
</form>

