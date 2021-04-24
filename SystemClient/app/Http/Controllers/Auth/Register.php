<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\PasswordEncoder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Register extends Controller
{

    public function index()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {

        $email = $request->get('email');
        $haslo = PasswordEncoder::base64_encode($request->get('haslo'));
        $imie = $request->get('imie');
        $nazwisko = $request->get('nazwisko');


//      check if email exists
        $email_exists = User::where('email', $email)->first();

        if($email_exists)
        {
            $message = 'Użytkownik z takim adresem e-mail już istnieje.';
            $response = AjaxResponse::custom($message, 'danger');
            return back()->with(['message' => $response]);
        }

        $role = Role::where('name', 'Klient')->first();

        User::create([
           'email' => $email,
           'role_id' => $role->id,
           'haslo' => $haslo,
           'imie' => $imie,
           'nazwisko' => $nazwisko
        ]);

        $message = 'Rejestracja przebiegła pomyślnie, możesz się teraz zalogować.';
        $response = AjaxResponse::success($message);
        return \redirect('/loginPage')->with(['message' => $response]);
    }


}
