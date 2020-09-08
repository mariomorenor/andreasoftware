<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $products = Product::with(['prices'])->get(['*','name as product']);
            if ($request->has('product')) {
                $products = Product::where('name','like',"$request->product%")->take(5)->with(['prices'])->get(['*','name as product']);
            }
            return response($products,200);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            try {
                $store = DB::transaction(function() use($request){
                    $price = new Price;
                    $price->fill($request->all());
                    $price->save();
                    $product = new Product;
                    $product->fill($request->all());
                    $product->price_id = $price->id;
                    $product->save();
                    // return $store;
                });
                 return response('ok',200);
            } catch (\Illuminate\Database\QueryException $e) {
              
                return response($e->errorInfo);
            }
         
            
          
             
         }
    }

    public function update(Request $request, Product $product)
    {
        
        if ($request->ajax()) {
            try {
             DB::transaction(function() use($request,$product){
                    $price = Price::find($product->price_id);
                    $price->fill($request->all());
                    $price->save();
                    $product->fill($request->all());
                    $product->save();

                });
                return response('ok',200);
                
            } catch (\Illuminate\Database\QueryException $e) {
                return response($e->errorInfo);
            }

        }
    }

    public function destroy(Product $product, Request $request)
    {
        if($request->ajax()){
            $product->delete();
            return response('',200);
        }
    }
}
