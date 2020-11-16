<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class userController extends Controller {

    public function showLoginView() {
        return view('login');
    }

    public function showRegisterView() {
        return view('register');
    }

    public function procesarRegistro() {
        //if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["username"], $_GET["date_birth"], $_GET["email"], $_GET["password"], $_GET["repeat_password"])) {

                $datos_registro = array([]);
                $datos_registro["username"] = $_GET["username"];
                $datos_registro["date"]  = $_GET["date_birth"];
                $datos_registro["email"]  = $_GET["email"];
                $password  = $_GET["password"];

                $repeat_password = $_GET["repeat_password"];

                if($password == $repeat_password) {
                    //Hash contraseña
                    $datos_registro["password"] = md5($password);

                    $newUser = new Usuario();
                    $newUser->name = $datos_registro["username"];
                    $newUser->email = $datos_registro["email"];
                    $newUser->password = $password;
                    $newUser->birthday = $datos_registro["date"];
                    $newUser->save();

                    $usuarios_registrados = Usuario::all();

                    return view('procesar_registro', ['usuarios_registrados' => $usuarios_registrados]);
                } else {
                    return "Ya existe el usuario, use otro nombre nuevo";
                }
            } else {
                return view('register');
            }
        //}
    }

    public function userAlreadyCreated($newUserName) {
        $checkUser = Usuario::where('name', $newUserName);
        return (!$checkUser);
    }
}
