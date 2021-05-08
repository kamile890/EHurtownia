<?php


namespace App\Http\Controllers\Products;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductsList extends Controller
{

    public function index()
    {
        $products = Product::all();
        $category = Category::all();

        return view('Products.products', compact('products', 'category'));
    }

    public function addProduct(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = "Pole 'Nazwa' jest wymagane.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('price'))
        {
            $message = "Pole 'Cena' jest wymagane.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if($request->get('price') <= 0)
        {
            $message = "Cena musi być większa od 0.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if($request->get('amount') < 0)
        {
            $message = "Ilość nie może być ujemna.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Product::create([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'image_path' => $request->get('image_path') ? $request->get('image_path') : null,
                'amount' => $request->get('amount'),
                'category_id' => (int)$request->get('category_id')
            ]);

            $message = 'Produkt został dodany!';
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

    public function editProduct(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = "Pole 'Nazwa' jest wymagane.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('price'))
        {
            $message = "Pole 'Cena' jest wymagane.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if($request->get('price') <= 0)
        {
            $message = "Cena musi być większa od 0.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if($request->get('amount') < 0)
        {
            $message = "Ilość nie może być ujemna.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Product::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'image_path' => $request->get('image_path') ? $request->get('image_path') : null,
                'amount' => $request->get('amount')
            ]);

            $message = 'Produkt został edytowany!';
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
