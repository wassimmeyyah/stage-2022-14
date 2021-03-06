<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <!-- si on veut lier √† un fichier css -->
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
            Etablissement : {{$type->TYPNom}} {{$etablissement->ETABNom}}
        </h3>
        <img src="C:\Users\33662\PhpstormProjects\stage-2022-18\public\Image\imageacad2.jpg" width="320" height="190" alt />

        <br>

        <center>
            <i>Informations de l'√©tablissement</i>
        </center>

        <br>

        <table class="table-style">
            <tr>
                <th scope="row">RNE de l'√©tablissement</th>
                <td> <strong> {{$etablissement->ETABCode}}  </strong> </td>
            </tr>
            <tr>
                <th scope="row">Nom de l'√©tablissement</th>
                <td><strong> {{$etablissement->ETABNom}} </strong> </td>
            </tr>
            <tr>
                <th scope="row">Mail de l'√©tablissement</th>
                <td>{{$etablissement->ETABMail}} </td>
            </tr>
            <tr>
                <th scope="row">Chef d'√©tablissement</th>
                <td>{{$etablissement->ETABChef}} </td>
            </tr>
            <tr>
                <th scope="row">Adresse de l'√©tablissement</th>
                <td>{{$etablissement->ETABAdresse}}</td>
            </tr>
            <tr>
                <th scope="row">Num√©ro de l'√©tablissement</th>
                <td>{{$etablissement->ETABTel}}</td>
            </tr>


        </table>

        <div>

        </div>
        <br>

        </div>
    </center>
</body>
