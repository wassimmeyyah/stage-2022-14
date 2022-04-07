<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="card-group">
                        <div class="card" style="width: 18rem;">
                            <img src="/Image/imageExp.png" class="card-img-top" alt="/Image/imageExp.png">
                            <div class="card-body">
                                <p class="card-text">
                                <p align="center">
                                    <a class="favorite styled text-secondary text-uppercase" type="button" href="{{route('goExperimentation')}}">
                                        Les expérimentations
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>
                        <div class="card" align="center" style="width: 18rem;">
                            <img src="/Image/imageEtab.png" class="card-img-top" alt="/Image/imageEtab.png">
                            <div class="card-body">
                                <p class="card-text">
                                <p align="center">
                                    <a class="favorite styled text-secondary text-uppercase" type="button" href="{{route('goEtablissement')}}">
                                        Les etablissements
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>
                        <div class="card" align="center" style="width: 18rem;">
                            <img src="/Image/imagePort.png" class="card-img-top" alt="/Image/imagePort.png">
                            <div class="card-body">
                                <p class="card-text">
                                <p align="center">
                                    <a class="favorite styled text-secondary text-uppercase" type="button" href="{{route('goPorteur')}}">
                                        Les porteurs de projet
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>
                        <div class="card" align="center" style="width: 18rem;">
                            <img src="/Image/imagePers.jpg" class="card-img-top" alt="/Image/imagePers.jpg">
                            <div class="card-body">
                                <p class="card-text">
                                <p align="center">
                                    <a class="favorite styled text-secondary text-uppercase" type="button" href="{{route('goPersonnelacad')}}">
                                        Les accompagnateurs de projet
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>
                        <div class="card" align="center" style="width: 18rem;">
                            <img src="/Image/imageCarte.png" class="card-img-top" alt="/Image/imageCarte.png">
                            <div class="card-body">
                                <p class="card-text">
                                <p align="center">
                                    <a class="favorite styled text-secondary text-uppercase" type="button" href="{{route('goCarte')}}">
                                        La cartographie
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>


</x-app-layout>