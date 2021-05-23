<?php


namespace App\Http\Controllers\Koszyk;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class Zamowienie extends Controller
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

        return view('Zamowienie.zamowienie', compact('products', 'price'));
    }

}
