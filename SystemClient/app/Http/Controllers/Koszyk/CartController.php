<?php


namespace App\Http\Controllers\Koszyk;


use App\Http\Controllers\Controller;
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


        return view('Cart.cart', compact('products', 'price'));
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



        return back()->withCookie('cart', serialize($cart));
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
