<?php

namespace App\Http\Controllers;

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

                    //CODIGO PARA INSERTAR DATOS EN UN FICHERO
                    // =================================================

                    /*echo "Nombre: " . $datos_registro["username"];
                    cho "Nacimiento: " . $datos_registro["date"];
                    echo "Email: " . $datos_registro["email"];
                    echo "Contraseña: " . $password;
                    $mi_archivo = fopen("usuarios.txt", "a") or die("No se pudo guardar el usuario");
                    $datos_registro["password"] = md5($password);

                    fwrite($mi_archivo, " Nombre: " . $datos_registro["username"] .
                                                " Nacimiento: " . $datos_registro["date"] .
                                                " email: " . $datos_registro["email"] .
                                                " Contraseña: " . $datos_registro["password"] . "\n");
                    fclose($mi_archivo);*/

                    // =================================================





                    return view('procesar_registro', ['usuario' => $datos_registro]);
                } else {
                    return view('procesar_registro');
                }
            } else {
                return view('register');
            }
        //}
    }
}
