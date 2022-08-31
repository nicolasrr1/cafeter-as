<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use DB;

class ProductsController extends Controller
{
    /**
     * @var DB
     * @return $response
     */
    //lista de productos
    public function listProducts()
    {
        try {
            $response = DB::table('products')->select('products.*', 'category.name_category')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->get();
            return view('home')->with('products', $response);
        } catch (\Throwable $th) {
            $response = $th;
        }
        return response()->json($response);
    }

    /**
     * @param arry Request
     * @var Products
     * @return void
     */
    //crear producto 
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'reference' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'category_id' => 'required'
        ]);



        if ($request->hasFile('reference')) {
            $file = $request->file('reference');
            $destinationPath = "img/featureds/";
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('reference')->move($destinationPath, $filename);
        }
        Products::create([
            'name' => $request->name,
            'reference' => $destinationPath . $filename,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);


        return back();
    }

    /**
     * @param arry Request
     * @var DB
     * @return void
     */
    //crear update

    public function updateProduct(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'reference' => 'required',
                'price' => 'required',
                'weight' => 'required',
                'stock' => 'required',
                'category_id' => 'required',
                'id' => 'required'
            ]);

            if ($request->hasFile('reference2')) {
                $file = $request->file('reference2');
                $destinationPath = "img/featureds/";
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('reference2')->move($destinationPath, $filename);
                $reference = $destinationPath . $filename;
            } else {
                $reference = $request->reference;
            }


            DB::table('products')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'reference' => $reference,
                    'price' => $request->price,
                    'weight' => $request->weight,
                    'stock' => $request->stock,
                    'category_id' => $request->category_id
                ]);

            return back();
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }


    /**
     * @param int $id
     * @var DB
     * @return void
     */
    //eliminar productos 
    public function deleteProducts($id)
    {
        try {
            DB::table('products')->where('id', '=', $id)->delete();
            return back();
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
