<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParkingController extends Controller
{

    function parking(Request $request) {

        $valid = $request->validate([
            'nom' => 'nullable'
        ]);

        $params = [
            'result' => false,
            'isError' => false,
            'error' => '',
            'data' => []
        ];

        if(isset($valid['nom'])) {
            $params['result'] = true;
            $response = Http::get("https://opendata.lillemetropole.fr/api/explore/v2.1/catalog/datasets/disponibilite-parkings/records",
                [
                    'limit' => 1,
                    'select' => 'libelle,etat,adresse,dispo,max,ville',
                    'where' => "libelle LIKE \"*" . $valid['nom'] . "*\""
                ]);
            if($response->failed()) {
                $params['isError'] = true;
                $params['error'] = 'Il y a eu une erreur lors de la requête, rééessayez plus tard.';
            } else {
                $data = $response->json();
                if($data['total_count'] > 0) {
                    $params['data'] = $data['results'][0];
                } else {
                    $params['isError'] = true;
                    $params['error'] = 'Aucun résultat !';
                }
            }

        }

        return view('parking', $params);
    }

    function parkings() {

        $response = Http::get("https://opendata.lillemetropole.fr/api/explore/v2.1/catalog/datasets/disponibilite-parkings/records",
            [
                'limit' => 50,
                'select' => 'libelle,etat,adresse,dispo,max,ville',
            ]
        );

        $params = [
            'isError' => false,
            'error' => '',
            'data' => []
        ];

        if($response->failed()) {
            $params['isError'] = true;
            $params['error'] = 'Il y a eu une erreur lors de la requête, rééessayez plus tard.';
        } else {
            $data = $response->json();
            $params['data'] = $data['results'];
        }

        return view('parkings', $params);
    }
}
