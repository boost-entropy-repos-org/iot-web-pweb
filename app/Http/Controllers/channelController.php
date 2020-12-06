<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\sensorData;
use Illuminate\Http\Request;

class channelController extends Controller {
    public function showChannelsView() {
        return view('canales');
    }

    public function añadirCanal() {
        if(isset($_GET["nombre_canal"], $_GET["nombre_sensor"], $_GET["descripcion"], $_GET["longitud"], $_GET["latitud"])) {
            $canal = new Channel();
            $canal->id_user = session('id');
            $canal->channel_name = $_GET["nombre_canal"];
            $canal->sensor_name = $_GET["nombre_sensor"];
            $canal->description = $_GET["descripcion"];
            $canal->longitude = $_GET["longitud"];
            $canal->latitude = $_GET["latitud"];
            $canal->save();
        }

        return redirect('canales');
    }

    public function eliminarCanal($id) {
        $canalBorrar = Channel::find($id);
        $canalBorrar->delete();
        return redirect('canales');
    }

    public function getUltimosCanales() {
        $ultimosCanales = \App\Models\Channel::orderBy('created_at','desc')
            ->take(2)
            ->get();

         return $ultimosCanales;
    }

    public function getNumCanales() {
        $numChannels = count(Channel::all());
        return $numChannels;
    }

    //SERVICIO WEB PARA RECOGER DATOS DE UN CANAL DETERMINADO ENTRE DOS FECHAS

    public function getSensorDataBetweenDates() {
        if(isset($_GET["channel"], $_GET["date1"], $_GET["date2"])) {
            $fecha_inicio = $_GET["date1"] . " 00:00:00";
            $fecha_final = $_GET["date1"] . " 23:59:59";

            $datosSensor = sensorData::where('id_channel', $_GET["channel"])
                        ->whereBetween('created_at', [$fecha_inicio, $fecha_final])
                        ->get();

            $data=array();
            $i=0;
            foreach ($datosSensor as $fila) {
                $data[$i][0] = date("Y-m-d H:i:s", strtotime($datosSensor[$i]["created_at"]));
                $data[$i][1] = floatval($fila['data']);
                $i++;
            }

            header('Content-type: application/json');
            return json_encode($data);
        }
    }
}
