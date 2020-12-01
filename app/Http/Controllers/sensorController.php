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
            $datosSensor[$i]["created_at"] = strtotime($time);
        }

        $data=array();
        $i=0;
        foreach ($datosSensor as $fila) {
            $data[$i][0] = date("Y-m-d H:i:s", strtotime($datosSensor[$i]["created_at"]));
            $data[$i][1] = floatval($fila['data']);
            $i++;
        }

        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function generarDatosRand($id) {
        for ($i = 0; $i < 10; $i++) {
            $sensor = new sensorData();
            $sensor->id_channel = $id;
            $sensor->data = rand(0, 2);
            $sensor->save();
        }
    }

    public function getNumSensorData() {
        $numSensorData = count(sensorData::all());
        return $numSensorData;
    }

    public function getSizeDB() {
        $tamañoTablasBD = \Illuminate\Support\Facades\DB::select(
            "SELECT TABLE_NAME AS `Table`, round(((data_length + index_length) / 1024), 2) AS `sizeKB`
                                FROM information_schema.TABLES
                                WHERE TABLE_SCHEMA = \"mywebiot\"
                                ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC;");

        $tamañoDB = 0;
        foreach ($tamañoTablasBD as $tamañoTabla) {
            $tamañoDB += $tamañoTabla->sizeKB;
        }

        return $tamañoDB;
    }
}
