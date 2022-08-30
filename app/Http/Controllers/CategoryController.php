<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CategoryController extends Controller
{
    public function getCategory(){
            $data = DB::table('category')->select('id','name_category')->get();
            return response()->json($data);
    }
}
