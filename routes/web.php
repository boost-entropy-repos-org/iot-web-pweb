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

Route::get('/login', [\App\Http\Controllers\userController::class, 'showLoginView']);

Route::get('/registro', [\App\Http\Controllers\userController::class, 'showRegisterView']);

Route::get('/canales', [\App\Http\Controllers\channelController::class, 'showChannelsView']);

Route::get('/procesar_registro', [\App\Http\Controllers\userController::class, 'procesarRegistro']);
