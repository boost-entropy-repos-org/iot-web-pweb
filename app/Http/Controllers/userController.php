<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

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
                $datos_registro["password"]  = $_GET["password"];
                $repeat_password = $_GET["repeat_password"];

                if($datos_registro["password"] == $repeat_password) {

                    if ($this->emailAlreadyCreated($_GET["email"])){
                        return view('register', ['invalid_email' => true]);

                    } else {
                        $this->insertUser($datos_registro);
                        session_start();
                        $_SESSION['username'] = $datos_registro["username"];
                        return view('index');
                    }
                }
            } else {
                return view('register');
            }
        //}
    }

    public function emailAlreadyCreated($newEmail) {
        return Usuario::where('email', $newEmail)->exists();
    }

    public function insertUser($userInformation) {
        $newUser = new Usuario();
        $newUser->name = $userInformation["username"];
        $newUser->email = $userInformation["email"];
        $newUser->password = md5($userInformation["password"]);
        $newUser->birthday = $userInformation["date"];
        $newUser->save();
    }
}
