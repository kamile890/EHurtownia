<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Http\Controllers\Helpers\PasswordEncoder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{

    public function index()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $haslo = PasswordEncoder::base64_encode($request->get('haslo'));
        $remember = $request->get('remember');

        $user = User::where('email', $email)->first();

        if(!$user)
        {
            $message = 'Użytkownik o podanym adresie email nie istnieje.';
            $response = HttpResponse::custom($message, 'danger');
            return back()->with(['message' => $response]);
        }

        if($haslo != $user->haslo)
        {
            $message = 'Podane hasło jest nieprawidłowe.';
            $response = HttpResponse::custom($message, 'danger');
            return back()->with(['message' => $response]);
        }

        $message = 'Pomyślnie zalogowano.';
        $response = HttpResponse::success($message);

        $role = Role::where('id', $user->role_id)->first();
        Session::push('loggedRole', $role->name);
        Session::push('logged', true);
        Session::push('client', serialize($user->toArray()));

        if($role->name == 'Administrator')
        {
            return redirect('/dealers')->with(['message' => $response]);
        }

        return redirect('/')->with(['message' => $response]);

    }

    public function logout()
    {
        Session::forget(['logged', 'loggedRole', 'client']);
        return redirect('/');
    }

}
