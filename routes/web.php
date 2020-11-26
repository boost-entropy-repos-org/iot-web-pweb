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

Route::get('/procesar_registro', [\App\Http\Controllers\userController::class, 'procesarRegistro']);

Route::get('/procesar_login', [\App\Http\Controllers\userController::class, 'procesarLogin']);

Route::get('/cerrar_sesion', [\App\Http\Controllers\userController::class, 'cerrarSesion']);

Route::get('/añadir_canal', [\App\Http\Controllers\channelController::class, 'añadirCanal']);

Route::get('/eliminarCanal/{id}', [\App\Http\Controllers\channelController::class, 'eliminarCanal']);

Route::get('/channelJSON/{id}', [\App\Http\Controllers\sensorController::class, 'getJSONData']);

Route::get('/getNumUsers', [\App\Http\Controllers\userController::class, 'getNumUsers']);

Route::get('/getUltimosCanales', [\App\Http\Controllers\channelController::class, 'getUltimosCanales']);


Route::get('/graficaCanal/{id}', function ($id) {
    return view('graficaCanal', ['id' => $id]);
});

Route::get('/nuevoCanal', function () { return view('añadirNuevoCanal');});





