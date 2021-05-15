<?php


namespace App\Http\Controllers\Orders;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie;

class OrdersController extends Controller
{

    public function order(Request $request)
    {

        if(!Session::get('client'))
        {
            $message = 'Musisz być zalogowany, aby złożyć zamówienie.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $client_id = (unserialize(Session::get('client')[0]))->id;
        $client = User::where('id', $client_id)->first();

        $products = unserialize($request->cookie('cart'));
        if(empty($products))
        {
            $message = 'Koszyk jest pusty';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $serialized = serialize($products);

        $params = [
            'order_number' => time(),
            'client_id' => $client->id,
            'products' => $serialized,
            'price' => $request->get('price'),
            'delivery_type_id' => 1,
            'realized' => 0,
        ];

        try
        {

            if(!$client->miasto || !$client->kodpocztowy || !$client->ulica || !$client->numermieszkania)
            {
                $message = 'Dane do wysyłki nie są zupełne. Uzupełnij je i złóż zamówienie ponownie.';
                $response = HttpResponse::error($message);
                return back()->with(['message' => $response]);
            }

            Order::create($params);
            $cookie1 = \Illuminate\Support\Facades\Cookie::forget('cart');
            $message = 'Zamówienie zostało złożone.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response])->withCookie($cookie1);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

}
