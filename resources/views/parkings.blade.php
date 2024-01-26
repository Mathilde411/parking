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
        <h1>Liste des parkings</h1>
    </div>
    <div>
        <a href="/parking">Accéder à la recherche individuelle.</a>
    </div>
    <div>
        @if($isError)
            <h3>Erreur !</h3>
            <p>{{$error}}</p>
        @else
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Etat</th>
                    <th>Places</th>
                </tr>
                @foreach($data as $element)
                    <tr>
                        <td>{{$element['libelle']}}</td>
                        <td>{{$element['adresse']}}, {{$element['ville']}}</td>
                        <td>{{$element['etat']}}</td>
                        <td>{{$element['dispo']}}/{{$element['max']}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</body>
</html>
