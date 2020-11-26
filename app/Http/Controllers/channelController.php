<?php

namespace App\Http\Controllers;

use App\Models\Channel;
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
}
