<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SalesController extends Controller
{
    public function index()
    {
        try {
            $products = DB::table('products')->select('products.*', 'category.name_category')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->get();
            $basket = DB::table('products')->select('products.*', 'category.name_category' , 'basket.')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->join('basket', 'products.id', '=', 'basket.products_id')
                ->get();
            return view('sales')->with('products', $products)->with('basket', $basket);
        } catch (\Throwable $th) {
            return response()->json($response);
        }
    }
}
