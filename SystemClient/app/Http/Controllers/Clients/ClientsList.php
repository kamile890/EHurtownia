<?php


namespace App\Http\Controllers\Clients;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpRequestHelper;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Custom;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ClientsList extends Controller
{

    public function index()
    {
        $clients = User::where('role_id', Role::where('id', 3)->first()->id)->get();
        return view('Clients.clients', compact('clients'));
    }


    public function editClient(Request $request)
    {
        try
        {
            $params = HttpRequestHelper::getArray($request->all());
            User::where('id', $request->get('id'))->update($params);
            $message = 'Klient został edytowany!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }
    }

}
