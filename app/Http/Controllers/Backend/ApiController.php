<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\MainCategory;
use App\Models\Backend\Product;
use App\Models\Backend\ShippingCharge;
use App\Models\Backend\Stock;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class ApiController extends Controller{
    public function getProductListToCreateOrder(Request $request){
        try{
            $main_cat = $request->main_category;
            $sub_cat = $request->sub_category; 
            $product_list = Product::select(
                'id',
                'product_name',
                'product_images',
                'sku',
                'product_status',
                'main_category',
                'sub_category',
                'tax_id',
                'tax_name',
                'tax_rate'
                )->whereHas('getStock')->with('getStock:id,product_id,quantity,attribute_id,attribute_value_id,price_1,price_2,price_3,price_4,price_5,price_6,price_7,price_8,price_9,price_10,price_11,price_12,stock_staus,status');
           
            if($main_cat != '' && $sub_cat != ''){ 
                $main_category = MainCategory::where('id', $main_cat)->first();
                $sub_category = SubCategory::where('id', $sub_cat)->first();
                $product_list = $product_list->whereJsonContains('main_category', $main_category->id);
                $product_list = $product_list->whereJsonContains('sub_category', $sub_category->id); 
                $product_list = $product_list->orderBy('id', 'desc')->get()
                 ->map(function ($product) {
                $product->getStock->transform(function ($stock) {
                    // Move all price fields into a single 'prices' array
                    $stock->prices = [
                        'price_1' => $stock->price_1,
                        'price_2' => $stock->price_2,
                        'price_3' => $stock->price_3,
                        'price_4' => $stock->price_4,
                        'price_5' => $stock->price_5,
                        'price_6' => $stock->price_6,
                        'price_7' => $stock->price_7,
                        'price_8' => $stock->price_8,
                        'price_9' => $stock->price_9,
                        'price_10' => $stock->price_10,
                        'price_11' => $stock->price_11,
                        'price_12' => $stock->price_12,
                    ];
                    
                    // Remove the old price columns
                    // unset(
                    //     $stock->price_1, $stock->price_2, $stock->price_3, $stock->price_4,
                    //     $stock->price_5, $stock->price_6, $stock->price_7, $stock->price_8,
                    //     $stock->price_9, $stock->price_10, $stock->price_11, $stock->price_12
                    // );

                    return $stock;
                });

                return $product;
            });
                
                return response()->json([
                    "status" => "success",
                    "data" => $product_list
                ], 200); 
            }else{
                $product_list = $product_list->orderBy('id', 'desc')->get(); 
                return response()->json([
                    "status" => "success",
                    "comment" => "all recored",
                    "data" => $product_list
                ], 400);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "error" => $e->getMessage()
            ], 400);
        }
    }


    public function getVariantStock(Request $request){
        try{
            $stock = Stock::with('getAttrValue')->where('product_id', $request->product_id)->where('attribute_value_id', $request->attr_val_id)->first();
            return response()->json([
                "status" => "success",
                "data" => $stock,
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    public function getShippingCharge(){
        try{
            $shipping_charge = ShippingCharge::where('status', 1)->first();
            return response()->json([
                "status" => "success",
                "name" => $shipping_charge->name,
                "shipping_charge" => $shipping_charge->amount,
            ], 200);
            
        }catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
