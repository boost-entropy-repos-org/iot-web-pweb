<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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
                        return redirect('/registro')->with('error','El email introducido ya está registrado');
                    } else {
                        $this->insertUser($datos_registro);
                        $this->loginUser($datos_registro["email"]);
                        return redirect('/')->with('exito','Se ha registrado correctamente');
                    }
                } else {
                    return redirect('/registro')->with('error','Las contraseñas son diferentes');
                }
            } else {
                return redirect('/registro')->with('error','Uno de los campos no se ha introducido correctamente');
            }
        //}
    }

    public function cerrarSesion() {
        session()->flush();
        return redirect('/')->with('exito', 'Ha cerrado sesión correctamente');
    }

    public function procesarLogin() {
        if(isset($_POST["email"], $_POST["password"])) {
            $email = $_POST["email"];
            $password = md5($_POST["password"]);

            if($this->validateUserLogin($email, $password)) {
                $this->loginUser($email);
                return redirect('/')->with('exito','Ha iniciado sesión correctamente');
            } else {
                return redirect('/login')->with('error','El email o la contraseña son incorrectos');
            }
        }
    }

    public function loginUser($email) {
        $usuario = Usuario::where('email',$email)->first();
        session(['username' => $usuario->name]);
        session(['id' => $usuario->id]);
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

        $usuario = Usuario::where('email',$userInformation["email"])->first();

        $newProfile = new Profile();
        $newProfile->id_user = $usuario->id;
        $newProfile->description = "Mi primer estado";
        $newProfile->img = "/img/imagen-perfil.png";
        $newProfile->save();
    }

    public function getNumUsers() {
        $numUsers = count(Usuario::all());
        return $numUsers;
    }
}
