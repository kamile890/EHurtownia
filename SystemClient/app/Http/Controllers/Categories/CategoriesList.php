<?php


namespace App\Http\Controllers\Categories;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesList extends Controller
{

    public function index()
    {

        $categories = Category::all();

        return view('Categories.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = "Pole 'Nazwa' jest wymagane.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $category = Category::where('name', $request->get('name'))->first();

        if($category)
        {
            $message = "Kategoria o takiej nazwie juz istnieje.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Category::create([
               'name' => $request->get('name')
            ]);

            $message = 'Kategoria została dodana!';
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
