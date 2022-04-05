<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/user.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>


<body>
    <div class="container">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    {{ __('Modification') }} : {{ __($user->name) }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div style="height:175px;display:block;"> </div>
                            <div class="row justify-content-center">


                                <div class="col-md-8">
                                    <div class="card">

                                        <div class="card-header">Modifier <strong>{{ $user->name}}</strong></div>
                                        <div class="card-body">
                                            <form action="{{ route('goUserModifier', $user) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                @foreach($roles as $role)
                                                <div class="form-group form-check" style="height:40px;display:block;">
                                                    <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}" id="{{ $role->id }}" @if ($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                    <label for="{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                                                </div>
                                                @endforeach
                                                <button class="btn btn-light text-primary">Modifier les rôles</button>
                                                <a class="btn btn-danger" href="{{route('goUser')}}">Annuler</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>