<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Parking</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
        }

        div {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 10px;
        }
    </style>
</head>
<body>
<div>
    <h1>Recherche</h1>
</div>
<div>
    <a href="/">Accéder à la liste.</a>
</div>
<div>
    <form action="/parking" method="get">
        <label>
            Nom
            <input type="text" name="nom"/>
        </label>
        <input type="submit" value="Recherche">
    </form>
</div>
@if($result)
    <div>
        @if($isError)
            <h3>Erreur !</h3>
            <p>{{$error}}</p>
        @else
            <table>
                <tr>
                    <th>Nom</th>
                    <td>{{$data['libelle']}}</td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td>{{$data['adresse']}}, {{$data['ville']}}</td>
                </tr>
                <tr>
                    <th>Etat</th>
                    <td>{{$data['etat']}}</td>
                </tr>
                <tr>
                    <th>Places</th>
                    <td>{{$data['dispo']}}/{{$data['max']}}</td>
                </tr>
            </table>
        @endif
    </div>
@endif
</body>
</html>
