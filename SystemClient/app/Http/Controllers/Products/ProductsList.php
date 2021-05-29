<?php


namespace App\Http\Controllers\Products;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\FileHelper;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ProductsList extends Controller
{

    public function index()
    {
        $productss = Product::where('deleted', 0)->get();
        $category = Category::all();
        $products = [];

        foreach($productss as $product)
        {
            $product = $product->toArray();
            $categor = Category::where('id', $product['category_id'])->first();
            $product[] = $categor->toArray();
            $products[] = $product;
        }

        return view('Products.products', compact('products', 'category'));
    }

    public function addProduct(Request $request)
    {



        $filename = FileHelper::saveFile($request->image_path);


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

        $product = Product::where('name', $request->get('name'))->first();

        if($product)
        {
            $message = "Produkt o takiej nazwie już istnieje.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if($request->get('amount') < 0)
        {
            $message = "Ilość nie może być ujemna.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!$request->get('category_id'))
        {
            $message = "Przedmiot musi być przypisany do kategorii.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Product::create([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'image_path' => $filename,
                'amount' => $request->get('amount'),
                'category_id' => (int)$request->get('category_id'),
                'deleted' => 0
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

        $filename = FileHelper::saveFile($request->image_path);

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

        $product = Product::where('name', $request->get('name'))->first();

        if($product && $product->name != $request->get('name'))
        {
            $message = "Produkt o takiej nazwie już istnieje.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Product::where('id', $request->get('id'))->update([
                'name' => $request->get('name'),
                'price' => $request->get('price') ? $request->get('price') : 0,
                'image_path' => $filename,
                'amount' => $request->get('amount') ? $request->get('amount') : 0,
                'category_id' => $request->get('category_id')
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

    public function deleteProduct(Request $request)
    {

        try
        {
            Product::where('id', $request->get('id'))->update([
                'deleted' => 1
            ]);

            $message = 'Produkt został usunięty!';
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

    public function restoreProduct(Request $request)
    {

        try
        {
            Product::where('id', $request->get('id'))->update([
                'deleted' => 0
            ]);

            $message = 'Produkt został przywrócony!';
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
