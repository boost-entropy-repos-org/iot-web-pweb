<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/ayuda', function () {
    return view('ayuda');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/canales', function () {
    return view('canales');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registro', [\App\Http\Controllers\userController::class, 'showRegisterView']);

Route::get('/canales', [\App\Http\Controllers\channelController::class, 'showChannelsView']);

Route::post('/procesar_registro', [\App\Http\Controllers\userController::class, 'procesarRegistro']);

Route::post('/procesar_login', [\App\Http\Controllers\userController::class, 'procesarLogin']);

Route::get('/cerrar_sesion', [\App\Http\Controllers\userController::class, 'cerrarSesion']);

Route::get('/añadir_canal', [\App\Http\Controllers\channelController::class, 'añadirCanal']);

Route::get('/eliminarCanal/{id}', [\App\Http\Controllers\channelController::class, 'eliminarCanal']);

Route::get('/channelJSON/{id}', [\App\Http\Controllers\sensorController::class, 'getJSONData']);

Route::get('/channelJSON/{id}', [\App\Http\Controllers\sensorController::class, 'getJSONData']);

Route::get('/generarDatosRand/{id}', [\App\Http\Controllers\sensorController::class, 'generarDatosRand']);

Route::get('/getUltimosCanales', [\App\Http\Controllers\channelController::class, 'getUltimosCanales']);

Route::get('/getSensorDataBetweenDates', [\App\Http\Controllers\channelController::class, 'getSensorDataBetweenDates']);



Route::get('/graficaCanal/{id}', function ($id) {
    return view('graficaCanal', ['id' => $id]);
});

Route::get('/nuevoCanal', function () { return view('añadirNuevoCanal');});

//RUTAS PARA INFORMACIÓN EN AJAX

Route::get('/getNumCanales', [\App\Http\Controllers\channelController::class, 'getNumCanales']);

Route::get('/getSizeDB', [\App\Http\Controllers\sensorController::class, 'getSizeDB']);

Route::get('/getNumUsers', [\App\Http\Controllers\userController::class, 'getNumUsers']);

//TIENDA

Route::get('/tienda', function () {
    if(session('username') == 'admin')
        return view('shopBackend');
    else
        return view('tienda');
});

Route::post('/verProducto', [\App\Http\Controllers\ProductController::class, 'verProducto']);









