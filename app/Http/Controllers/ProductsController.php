<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use DB;
use App\Http\Requests\ProductosRequest;

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
    public function createProduct(ProductosRequest $request)
    {

        try {
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
            $type = "success";
            $message = "Datos registrados correctamente ";
        } catch (\Throwable $th) {
            $type = "warning";
            $message =  $th;
        }

        return back()->with($type,  $message);
    }

    /** 
     * @param  ProductosRequest $request
     * @var DB
     * @return void
     */
    //crear update

    public function updateProduct(ProductosRequest $request)
    {
        try {

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

            $type = "success";
            $message = "Datos registrados correctamente ";
        } catch (\Throwable $th) {
            $type = "warning";
            $message =  $th;
        }
        return back()->with($type,  $message);
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
            $type = "success";
            $message = "Datos eliminados correctamente ";
        } catch (\Throwable $th) {
            $type = "warning";
            $message =  $th;
        }
        return back()->with($type,  $message);
    }
}
