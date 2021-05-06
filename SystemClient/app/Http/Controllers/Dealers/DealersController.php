<?php


namespace App\Http\Controllers\Dealers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Http\Controllers\Helpers\PasswordEncoder;
use App\Http\Controllers\Helpers\PasswordGenerator;
use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;

class DealersController extends Controller
{

    public function index()
    {
        $dealers = User::where('role_id', '2')->get();

        return view('Dealers/dealers', compact('dealers'));
    }

    public function addDealer(Request $request)
    {

        if(!$request->get('imie'))
        {
            $message = 'Imie nie może być puste.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('nazwisko'))
        {
            $message = 'Nazwisko nie może być puste.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('email'))
        {
            $message = 'Email nie może być pusty.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $hurtownik = User::where('email', $request->get('email'))->where('role_id', '2')->first();

        if($hurtownik)
        {
            $message = 'Użytkownik z takim adresem email już istnieje.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            User::create([
               'imie' => $request->get('imie'),
               'nazwisko' => $request->get('nazwisko'),
               'email' => $request->get('email'),
               'role_id' => 2,
               'haslo' => PasswordEncoder::base64_encode(PasswordGenerator::getPassword()),
               'numer_telefonu' => $request->get('phone') ? $request->get('phone') : null,
            ]);
            $message = 'Hurtownik został utworzony!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch (\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function editDealer(Request $request)
    {

        if(!$request->get('imie'))
        {
            $message = 'Imie nie może być puste.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('nazwisko'))
        {
            $message = 'Nazwisko nie może być puste.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('email'))
        {
            $message = 'Email nie może być pusty.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $hurtownik = User::where('email', $request->get('email'))->where('role_id', '2')->first();

        if($hurtownik && $hurtownik->id != $request->get('id'))
        {
            $message = 'Użytkownik z takim adresem email już istnieje.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            User::where('id', $request->get('id'))->update([
                'imie' => $request->get('imie'),
                'nazwisko' => $request->get('nazwisko'),
                'email' => $request->get('email'),
                'numer_telefonu' => $request->get('phone') ? $request->get('phone') : null,
            ]);
            $message = 'Successfully updated!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch (\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

}
