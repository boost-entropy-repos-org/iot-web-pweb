<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Profile;
use Carbon\PHPStan\MacroScanner;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    public function showSocialHome() {
        if(session('id') == null) {
            return view('social');
            return redirect('/')->with('error','Debe iniciar sesión para usar la red social');
        } else {
            return view('social');
        }
    }

    public function members() {
        return view('members');
    }

    public function followers() {
        return view('followers');
    }

    public function channels() {
        return view('followedChannels');
    }

    public function followUser($id_to_follow) {
        $friend = new Friend();
        $friend->id_user = session('id');
        $friend->id_friend = $id_to_follow;
        $friend->save();
        return redirect('/social/followers')->with('exito','Ahora estás siguiendo a un nuevo usuario');
    }

    public function unfollowUser($id_to_unfollow) {
        $user = Friend::where('id_user', session('id'))
                        ->where('id_friend', $id_to_unfollow)
                        ->first();
        $user->delete();
        return redirect('/social/followers')->with('error','Ya no sigue al usuario');
    }

    public function send() {
        if(isset($_POST['user'], $_POST['typeMsg'], $_POST['message'])) {
            $message = new \App\Models\Message();
            $message->id_auth = session('id');
            $message->id_recip = $_POST['user'];
            $message->message = $_POST['message'];
            $message->pm = $_POST['typeMsg'];
            $message->save();

            return redirect('/social/messages')->with('exito', 'Se ha enviado el mensaje correctamente');
        }
    }

    public function lastMessages() {
        $lastMessages = DB::table('messages')
                    ->join('usuarios as recip', 'messages.id_recip', '=', 'recip.id')
                    ->join('usuarios as auth', 'messages.id_auth', '=', 'auth.id')
                    ->where('messages.pm', 'p')
                    ->select('messages.*', 'recip.name as recipname', 'auth.name as authname')
                    ->orderBy('messages.created_at', 'DESC')
                    ->take(5)
                    ->get();

        $mensajes = array();
        foreach ($lastMessages as $message) {
            $auth = $message->authname;
            $recip = $message->recipname;
            $date = ' ['.$message->created_at.']';
            $content = $message->message;

            $messageContent = $auth . ' envió a ' . $recip . $date . ': '. $content;
            array_push($mensajes, $messageContent);
        }

        return $mensajes;
    }

    public function procesarEditarPerfil(Request $request)
    {
        $userProfile = Profile::where('id_user', session('id'))->first();

        if ($_POST['description'] != "") {
            $userProfile->description = $_POST['description'];
        }

        if ($request->file('imagenPerfil') != "") {
            // Get image file
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);

            $image = $request->file('imagenPerfil');

            // Make a image name based on user name and current timestamp
            $name = session('name') . '_' . time();

            // Define folder path
            $folder = '/uploads/profileImages/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $image->storeAs($folder, $name . '.' . $image->getClientOriginalExtension(), 'public');

            // Set user profile image path in database to filePath
            $userProfile->img = $filePath;
        }
        $userProfile->save();

        if (($_POST['description'] == "") && ($request->file('imagenPerfil') == "")) {
            return $_POST['description'];
            return redirect('/social/editProfile')->with('error', 'Rellene los campos correctamente');
        } else {
            return redirect('/social/editProfile')->with('exito', 'Se ha actualizado el perfil correctamente');
        }
    }
}
