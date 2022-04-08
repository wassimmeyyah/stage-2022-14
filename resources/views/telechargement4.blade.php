<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier à un fichier css -->
    <link rel="stylesheet" type="text/css" href="../../html/css/etablissement.css" />
    <style>
        *,
        ::before,
        ::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            justify-content: center;
        }

        body {
            height: 100vh;
            padding: 20px;
            font-family: Arial, Helvetica, sans-serif;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .table-style2 {
            border-collapse: collapse;
            box-shadow: 0 5px 50px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            margin: 0px auto;
            border: 2px solid midnightblue;
        }

        .table-style {
            border-collapse: collapse;
            box-shadow: 0 5px 50px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            margin: 0px auto;
            border: 2px solid midnightblue;
            width: 90%
        }

        thead tr {
            background-color: midnightblue;
            color: #fff;
            text-align: left;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: center;
        }

        tbody tr,
        td,
        th {
            border: 1px solid #ddd;
            max-width: 500px;
        }

        tbody tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        @media screen and (max-width: 550px) {
            body {
                align-items: flex-start;
            }

            .table-style {
                width: 100%;
                margin: 0px;
                font-size: 10px;
            }

            th,
            td {
                padding: 10px 7px;
            }

        }
    </style>
</head>


<body>

    <center class="table-style2">
        <br>
        <h3>
            Expérimentation : {{$experimentation->EXPTitre}}
        </h3>
        <img src="C:\Users\33662\PhpstormProjects\stage-2022-18\public\Image\imageacad2.jpg" width="320" height="190" alt />

        <br>

        <center>
            <i>Informations de l'expérimentation</i>
        </center>

        <br>

        <table class="table-style">
            <tr>
                <th scope="row">Titre de l'expérimentation</th>
                <td> <strong> {{$experimentation->EXPTitre}} </strong> </td>
            </tr>
            <tr>
                <th scope="row">Date de début de l'expérimentation</th>
                <td> {{$experimentation->EXPDateDebut}} </td>
            </tr>
            <tr>
                <th scope="row">Palier actuel de l'expérimentation</th>
                <td>{{$palier->PALLibelle}}</td>
            </tr>
            <tr>
                <th scope="row">Thématiques de l'expérimentation</th>
                <td>@foreach($thematiques as $thematique) {{$thematique->THEMALibelle}} - @endforeach</td>
            </tr>
            <tr>
                <th scope="row">Lien Internet</th>
                <td><a href="{{$experimentation->EXPLienInternet}}">Cliquez ici</a></td>
            </tr>
            <tr>
                <th scope="row">Lien du drive</th>
                <td><a href="{{$experimentation->EXPLienDrive}}">Cliquez ici</a></td>
            </tr>


        </table>


        <br>
        <br>

        <center>
            <i>Informations de l'établissement</i>
        </center>

        <br>

        <table class="table-style">
            <tr>
                <th scope="row">Etablissement concerné</th>
                <td> <strong> {{$type->TYPNom}} {{$etablissement->ETABNom}}</strong> </td>
            </tr>
            <tr>
                <th scope="row">Mail de l'établissement</th>
                <td> {{$etablissement->ETABMail}} </td>
            </tr>
            <tr>
                <th scope="row">Région de l'établissement</th>
                <td>{{$territoire->TERRNom}}</td>
            </tr>
            <tr>
                <th scope="row">Ville de l'établissement</th>
                <td>{{$ville->VILNom}}</td>
            </tr>
            <tr>
                <th scope="row">Type d'établissement</th>
                <td>{{$type->TYPNom}}</td>
            </tr>
            <tr>
                <th scope="row">Téléphone de l'établissement</th>
                <td>{{$etablissement->ETABTel}}</td>
            </tr>

        </table>

        <br>
        <br>

        <center>
            <i>Informations de(s) porteur(s) de projet</i>
        </center>

        <br>

        <table class="table-style">
            <thead>
                <tr>
                    <td> Porteur de projet </td>
                    <td> Mail du porteur </td>
                    <td> Téléphone du porteur </td>
                    <td> Etablissement du porteur </td>
                </tr>
            </thead>

            <tbody>
                @foreach($porteurs as $porteur)

                <tr>
                    <td> {{$porteur->PORTNom}} </td>
                    <td> {{$porteur->PORTMail}} </td>
                    <td> {{$porteur->PORTTel}} </td>
                    <td> {{$porteur->ETABCode}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>


        <br>
        <br>

        <center>
            <i>Informations de(s) accompagnateur(s) de projet</i>
        </center>

        <br>

        <table class="table-style">
            <thead>
                <tr>
                    <th> Accompagnateur de projet </th>
                    <th> Mail </th>
                    <th> Téléphone </th>
                    <th> Discipline </th>
                    <th> Fonction </th>

                </tr>
            </thead>
            <tbody>
                @foreach($personnelacads as $personnelacad)

                <tr>
                    <td> {{$personnelacad->PAPrenom}} {{$personnelacad->PANom}} </td>
                    <td> {{$personnelacad->PAMail}} </td>
                    <td> {{$personnelacad->PATel}} </td>
                    <td> {{$personnelacad->PADiscipline}} </td>
                    <td> {{$personnelacad->PAFonction}} </td>
                </tr>
                </td>
                @endforeach
            </tbody>
        </table>


        <br>
        <br>
        <center>
            <i>Document(s) du projet</i>
        </center>

        <table class="table-style">
            <tr>
                <th scope="row"> Lien du contrat d'accompagnement </th>
                <td><a href="{{$experimentation->ContratACLien}}">Cliquez ici</a></td>
            </tr>
            <tr>
                <th scope="row"> Lien du livret d'accompagnement </th>
                <td><a href="{{$experimentation->LivretACLien}}">Cliquez ici</a></td>
            </tr>
            <tr>
                <th scope="row"> Lien du dernier document de suivi </th>
                <td><a href="{{$experimentation->EXPDernierDocLien}}">Cliquez ici</a></td>
            </tr>
            <tr>
                <th scope="row"> Date du dernier document de suivi </th>
                <td><a>{{$experimentation->EXPDernierDocDate}}</a></td>
            </tr>

        </table>
        <br>

        <table class="table-style">
            <strong><i class="text-center text-uppercase bi bi-clock-history"> Historique des porteurs de projets : </i></strong> @foreach($porteur2s as $porteur)<a href="{{route('goPorteurAffichage', ['porteur'=>$porteur->PORTCode])}}"><td class="pt-3-half"  ><i class="bi bi-person-check-fill">  {{$porteur->PORTNom}} </i></td></a>@endforeach

        </table>
            <br>

            <table class="table-style">
            <strong><i class="text-center text-uppercase bi bi-clock-history"> Historique des accompagnateurs de projets : </i></strong> @foreach($personnelacad2s as $personnelacad)<a href="{{route('goPersonnelacadAffichage', ['personnelacad'=>$personnelacad->PACode])}}"><td class="pt-3-half" ><i class="bi bi-person-check-fill"> {{$personnelacad->PANom}} </i></td></a>@endforeach


        </table>
        <br>



    </center>
    <br>
</body>
