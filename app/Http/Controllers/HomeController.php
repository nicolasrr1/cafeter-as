<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{


    public function index()
    {
        try {
            $products = DB::table('products')->select('products.*', 'category.name_category')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->get();

            $category = DB::table('category')->select('id', 'name_category')->get();
            // dd($category);
            return view('home')->with('products', $products)->with('category', $category);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
