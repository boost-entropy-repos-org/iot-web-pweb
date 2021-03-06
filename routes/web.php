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

Route::get('/tienda/verProducto', [\App\Http\Controllers\ProductController::class, 'verProducto']);



// BACKEND TIENDA

Route::get('/tienda/nuevoProducto', function () {
    return view('addProduct');
});

Route::get('/tienda/consultarProducto', [\App\Http\Controllers\ProductController::class, 'consultarProducto']);

Route::get('/tienda/eliminarProducto', [\App\Http\Controllers\ProductController::class, 'eliminarProducto']);

Route::get('/tienda/editarProducto', [\App\Http\Controllers\ProductController::class, 'editarProducto']);

Route::post('/tienda/procesarEditarProducto', [\App\Http\Controllers\ProductController::class, 'procesarEditarProducto']);

Route::post('/tienda/añadirProducto', [\App\Http\Controllers\ShoppingCartController::class, 'añadirProducto']);

Route::post('/tienda/procesar_producto', [\App\Http\Controllers\ProductController::class, 'procesar_producto']);

Route::get('/tienda/getNumeroElementosCarro', [\App\Http\Controllers\ShoppingCartController::class, 'getNumeroElementosCarro']);

Route::get('/tienda/mostrarCarrito', [\App\Http\Controllers\ShoppingCartController::class, 'mostrarCarrito']);

Route::get('/tienda/vaciarCarrito', [\App\Http\Controllers\ShoppingCartController::class, 'vaciarCarrito']);

//PAYPAL

Route::get('/tienda/pagoPaypal', [\App\Http\Controllers\PaymentController::class, 'pagoPaypal']);

Route::get('/paypal/status', [\App\Http\Controllers\PaymentController::class, 'payPalStatus']);

//SOCIAL

Route::get('/social', [\App\Http\Controllers\SocialController::class, 'showSocialHome']);

Route::get('/social/members', [\App\Http\Controllers\SocialController::class, 'members']);

Route::get('/social/followers', [\App\Http\Controllers\SocialController::class, 'followers']);

Route::get('/social/channels', [\App\Http\Controllers\SocialController::class, 'channels']);

Route::get('/social/editProfile', function () {
    return view('editProfile');
});

Route::get('/social/messages', function () {
    return view('messages');
});

Route::get('/social/follow/{id}', [\App\Http\Controllers\SocialController::class, 'followUser']);

Route::get('/social/unfollow/{id}', [\App\Http\Controllers\SocialController::class, 'unfollowUser']);

Route::post('/social/send', [\App\Http\Controllers\SocialController::class, 'send']);

Route::get('/social/lastMessages', [\App\Http\Controllers\SocialController::class, 'lastMessages']);

Route::post('/social/procesarEditarPerfil', [\App\Http\Controllers\SocialController::class, 'procesarEditarPerfil']);







