<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Http\Controllers\Helpers\PasswordEncoder;
use App\Http\Controllers\Helpers\SenderHelper;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;


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
        $phone = $request->get('phone') ? $request->get('phone') : null;


//      check if email exists
        $email_exists = User::where('email', $email)->first();

        if($email_exists)
        {
            $message = 'Użytkownik z takim adresem e-mail już istnieje.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $role = Role::where('name', 'Klient')->first();

        $user = User::create([
           'email' => $email,
           'role_id' => $role->id,
           'haslo' => $haslo,
           'imie' => $imie,
           'nazwisko' => $nazwisko,
           'numer_telefonu' => $phone
        ]);

        $this->sendRegisterMessage($user->id);

        $message = 'Rejestracja przebiegła pomyślnie, możesz się teraz zalogować.';
        $response = HttpResponse::success($message);
        return \redirect('/loginPage')->with(['message' => $response]);
    }

    private function sendRegisterMessage($clientId)
    {
            SenderHelper::sendSMS(1, $this->getRegisterSMSTemplateId());
    }

    private function getRegisterSMSTemplateId()
    {
        $template = Template::where('name', Setting::where('name', 'selectedTemplate')->first()->value)->first();
        return $template->id;
    }

}
