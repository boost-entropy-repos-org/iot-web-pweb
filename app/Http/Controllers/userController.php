<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;
use Session;

class userController extends Controller {

    public function showLoginView() {
        return view('login');
    }

    public function showRegisterView() {
        return view('register');
    }

    public function procesarRegistro() {
        //if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_POST["username"], $_POST["date_birth"], $_POST["email"], $_POST["password"], $_POST["repeat_password"])) {

                $datos_registro = array([]);
                $datos_registro["username"] = $_POST["username"];
                $datos_registro["date"]  = $_POST["date_birth"];
                $datos_registro["email"]  = $_POST["email"];
                $datos_registro["password"]  = $_POST["password"];
                $repeat_password = $_POST["repeat_password"];

                if($datos_registro["password"] == $repeat_password) {

                    if ($this->emailAlreadyCreated($_POST["email"])){
                        return view('register', ['invalid_email' => true]);

                    } else {
                        $this->insertUser($datos_registro);
                        return view('index');
                    }
                }
            } else {
                return view('register');
            }
        //}
    }

    public function cerrarSesion() {
        session()->flush();
        return redirect('/');
    }

    public function procesarLogin() {
        if(isset($_POST["email"], $_POST["password"])) {
            $email = $_POST["email"];
            $password = md5($_POST["password"]);

            if($this->validateUserLogin($email, $password)) {
                $usuario = Usuario::where('email',$email)->first();
                session(['username' => $usuario->name]);
                session(['id' => $usuario->id]);
                return redirect('/');
            }
        }
    }

    public function validateUserLogin($email, $password) {
        if($this->emailAlreadyCreated($email)) {
            return Usuario::where('email', $email)
                            ->where('password', $password)
                            ->exists();
        }
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

    public function getNumUsers() {
        $numUsers = count(Usuario::all());
        return $numUsers;
    }
}
