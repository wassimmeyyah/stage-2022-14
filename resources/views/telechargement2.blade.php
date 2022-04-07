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
            Porteur : {{$porteur->PORTNom}}
        </h3>
        <img src="C:\Users\wassi\Desktop\Stage final\public\Image\imageacad2.jpg" width="320" height="190" alt />

        <br>

        <center>
            <i>Informations du porteur</i>
        </center>

        <br>

        <table class="table-style">
            <tr>
                <th scope="row">Nom du porteur</th>
                <td> <strong> {{$porteur->PORTNom}} </strong> </td>
            </tr>
            <tr>
                <th scope="row">Mail du porteur</th>
                <td> {{$porteur->PORTMail}} </td>
            </tr>
            <tr>
                <th scope="row">Numéro de téléphone du porteur</th>
                <td>{{$porteur->PORTTel}}</td>
            </tr>
            <tr>
                <th scope="row">Etablissement du porteur</th>
                <td>{{$etablissement->ETABNom}}</td>
            </tr>


        </table>

        <div>

        </div>
        <br>

        </div>
    </center>
</body>