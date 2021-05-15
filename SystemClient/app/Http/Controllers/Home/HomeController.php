<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

        public function index()
        {
            $categories = Category::all();
            $products = Product::all();

            return view('Home.home', compact('categories', 'products'));
        }

}
