<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Sale;

class SalesController extends Controller
{
    /**
     * @return arry $products
     * @return arry $sale
     * 
     */
    // Lista vista inicial venta cafeteria 
    public function index()
    {
        try {
            $suma = 0;
            $products = DB::table('products')->select('products.*', 'category.name_category')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->get();
            $sale = DB::table('products')->select('products.*', 'category.name_category', 'sale.amount','sale.payment', 'sale.id as sale_id')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->join('sale', 'products.id', '=', 'sale.products_id')
                ->where('sale.condition', '=', 0)
                ->get();

            foreach ($sale as $item) {
                $suma += $item->payment;
            }
            
            return view('sales')->with('products', $products)->with('sale', $sale)->with('suma', $suma);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }


    /**
     * @param arry $request
     * @var Sale
     * @return void
     */
    //Agregar productos a la cesta  
    public function create(Request $request)
    {
        try {
            $request->validate([
                'products_id' => 'required',
                'amount' => 'required',
                'payment' => 'required',
            ]);

            $stock = $this->CheckStock($request->products_id);
            $stock = $stock - $request->amount;

            if ($stock < 0) {
                $type = "warning";
                $message = "No hay unidades disponibles";
            } else {
                Sale::create([
                    'products_id' => $request->products_id,
                    'amount' => $request->amount,
                    'payment' => $request->payment,
                    'condition' => 0,
                ]);
                $type = "success";
                $message = "Datos registrados correctamente ";

                $this->discountProducts($request->products_id, $stock);
            }
        } catch (\Throwable $th) {
            $type = "warning";
            $message =  $th;
        }
        return back()->with($type, $message);
    }

    /**
     * @param int $products_id
     * @var DB
     * @return int $stock
     */
    //Consultar stock
    public function CheckStock($products_id)
    {
        try {
            $products =  DB::table('products')->select('stock')
                ->where('id', $products_id)->first();

            $response = $products->stock;
        } catch (\Throwable $th) {
            $response = $th;
        }


        return $products->stock;
    }

    /**
     * @param int $products_id
     * @param int $amount
     * @var DB
     * @return int $stock
     */
    // Descontar productos 
    public function discountProducts($products_id, $amount)
    {
        try {
            DB::table('products')
                ->where('id', $products_id)
                ->update([
                    'stock' => $amount,
                ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * @param arry $reques
     * @var DB
     * @return void
     */
    //vender producto
    public  function sell(Request $reques)
    {

        try {

            $sale_id = $reques->sale_id;

            foreach ($sale_id as $sale_id) {
                DB::table('sale')
                    ->where('id', $sale_id)
                    ->update([
                        'condition' => 1,
                    ]);
            }
            $type = "success";
            $message = "Datos registrados correctamente ";
        } catch (\Throwable $th) {
            $type = "warning";
            $message =  $th;
        }
        return back()->with($type, $message);
    }
}
