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

        .table-style {
            border-collapse: collapse;
            box-shadow: 0 5px 50px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            margin: 0px auto;
            border: 2px solid midnightblue;
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

    <center class="table-style">
        <br>
        <h3>
            Accompagnateur : {{$personnelacad->PANom}}
        </h3>
        <img src="C:\Users\wassi\Desktop\Stage final\public\Image\imageacad2.jpg" width="320" height="190" alt />

        <br>

        <center>
            <i>Informations de l'accompagnateur</i>
        </center>

        <br>

        <table class="table-style">
            <tr>
                <th scope="row">Nom de l'accompagnateur</th>
                <td> <strong> {{$personnelacad->PANom}} {{$personnelacad->PAPrenom}} </strong> </td>
            </tr>
            <tr>
                <th scope="row">Mail de l'accompagnateur</th>
                <td> {{$personnelacad->PAMail}} </td>
            </tr>
            <tr>
                <th scope="row">Numéro de téléphone de l'accompagnateur</th>
                <td>{{$personnelacad->PATel}}</td>
            </tr>
            <tr>
                <th scope="row">Discipline de l'accompagnateur</th>
                <td>{{$personnelacad->PADiscipline}}</td>
            </tr>
            <tr>
                <th scope="row">Fonction de l'accompagnateur</th>
                <td>{{$personnelacad->PAFonction}}</td>
            </tr>
            <tr>
                <th scope="row">Etablissement de l'accompagnateur</th>
                <td>{{$personnelacad->ETABCode}}</td>
            </tr>


        </table>

        <div>

        </div>
        <br>

        </div>
    </center>
</body>
