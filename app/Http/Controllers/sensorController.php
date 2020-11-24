<?php

namespace App\Http\Controllers;

use App\Models\sensorData;
use Illuminate\Http\Request;

class sensorController extends Controller
{
    public function getJSONData($channelID) {

        /*for ($i = 0; $i < 20; $i++) {
            $sensor = new sensorData();
            $sensor->id_channel = 15;
            $sensor->data = $i;
            $sensor->save();
        }*/

        $datosSensor = sensorData::select('created_at','data')
                                    ->where('id_channel', $channelID)
                                    ->get();

        //Ajustar tiempo
        for ($i = 0; $i < count($datosSensor); $i++) {
            $time = $datosSensor[$i]["created_at"];
            $datosSensor[$i]["created_at"] = strtotime($time) * 1000;
        }

        $data=array();
        $i=0;
        foreach ($datosSensor as $fila) {
            $data[$i][0] = $fila['created_at'];
            $data[$i][1] = floatval($fila['data']);
            $i++;
        }

        header('Content-type: application/json');
        echo json_encode($data);
    }
}
