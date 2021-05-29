<?php


namespace App\Http\Controllers\Koszyk;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {

        $productss = $request->cookie('cart') ? unserialize($request->cookie('cart')) : null;
        $products = [];
        if(!empty($productss))
        {
            foreach($productss as $product)
            {
                $prod = Product::where('id', $product['id'])->where('deleted', 0)->first();
                $products[] = ['product' => $prod, 'amount' => $product['amount'], 'price' => $prod['price'] * $product['amount']];
            }
        }
        $price = 0;
        foreach($products as $product)
        {
            $price += $product['product']['price'] * $product['amount'];
        }

        $empty = false;
        if(empty($products))
        {
            $empty = true;
        }

        return view('Cart.cart', compact('products', 'price', 'empty'));
    }

    public function addToCart(Request $request)
    {

        $cart = [];
        if($request->cookie('cart') !== null)
        {
            $cart = unserialize($request->cookie('cart'));
        }
        if(!empty($cart))
        {

            if($this->inCart($request, $request->get('id')))
            {
                foreach($cart as &$elem)
                {
                    if($elem['id'] == $request->get('id'))
                    {
                        $elem['amount'] += 1;
                    }
                }
            }
            else
            {
                $cart[] = ['id' => $request->get('id'), 'amount' => 1];
            }
        }
        else
        {
            $cart[] = ['id' => $request->get('id'), 'amount' => 1];
        }

        $message = 'Przedmiot dodano do koszyka.';
        $response = HttpResponse::success($message);

        return back()->withCookie('cart', serialize($cart))->with(['message' => $response]);
    }

    public function deletefromCart(Request $request)
    {

        $cart = unserialize($request->cookie('cart'));
        $newCart = [];
        foreach ($cart as $key=>$value)
        {
            if($key != $request->get('id'))
            {
                $newCart[] = $value;
            }
        }

        $message = 'Przedmiot usunięto z koszyka.';
        $response = HttpResponse::success($message);

        return back()->withCookie('cart', serialize($newCart))->with(['message' => $response]);



    }

    private function inCart($request, $id)
    {

        foreach(unserialize($request->cookie('cart')) as $elem)
        {
            if($elem['id'] == $id)
            {
                return true;
            }
        }
        return false;
    }
}
