<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class channelController extends Controller {
    public function showChannelsView() {
        return view('canales');
    }
}
