<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemperatureController extends Controller
{
    public function getColdTemperatures()
    {
        return DB::select('SELECT cidade.nome, temperatura_minima FROM previsao_clima INNER JOIN cidade WHERE cidade_id = cidade.id ORDER BY temperatura_minima ASC LIMIT 3');
    }

    public function getHotTemperatures() {
        return DB::select('SELECT cidade.nome, temperatura_maxima FROM previsao_clima INNER JOIN cidade WHERE cidade_id = cidade.id ORDER BY temperatura_maxima DESC LIMIT 3');
    }

    public function getNextSevenTemperatures($cityName) {
        $cityId = DB::select('SELECT id FROM cidade WHERE nome LIKE "%' . $cityName . '%"');
        if(empty($cityId)) {
            return array('status' => 'NOT_FOUND');
        }
        $cityId = $cityId[0]->id;
        return DB::select('select * from previsao_clima where data_previsao BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY data_previsao AND previsao_clima.cidade_id = "' . $cityId . '" LIMIT 7');
    }
}
