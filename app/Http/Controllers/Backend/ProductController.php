<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\Brand;
use App\Models\Backend\MainCategory;
use Illuminate\Http\Request;
use App\Models\Backend\Product;

class ProductController extends Controller
{
    public function index(){
        $product_list = Product::with('getBrand')->get(); 
        return view('backend.product.index', compact('product_list'));
    }

    public function create(){  
        $brand_list = Brand::where('status', 1)->get();
        $main_category_list = MainCategory::with('subCategory')->where('status', 1)->get();
        
        return view('backend.product.create', compact('brand_list', 'main_category_list'));
    }

    public function addAttribute(Request $request){  
        $formData = $request->all();
        
        if($request->has('product_attributes')){ 
            $productAttributes = $formData['product_attributes'];
            $attribute_list = Attribute::whereNotIn('id', $productAttributes)->get();
        }else{
            $attribute_list = Attribute::get();
        }
        return response()->json([
                'status' => 200,
                'message' => 'empty',
                'attributes' => $attribute_list,
                'data' => $formData
              ]); 

        // if($request->has('product_attributes')){ 
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'not_empty',
        //         'data' => $formData
        //       ]); 
        // }else{ 
        //     $attribute_list = Attribute::get();
        //   return response()->json([
        //     'status' => 200,
        //     'message' => 'empty',
        //     'attributes' => $attribute_list,
        //     'data' => $formData
        //   ]); 
        // }
    }

    public function getAttributeValue(Request $request){
        $attribute_val_list = AttributeValue::where('attribute_id', $request->attribute_id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'attributes_value' => $attribute_val_list
          ]); 
    }

    public function store(Request $request){
        // $formData = $request->all();
        // return $formData;
        // return $request->product_images;

        $product_name = $request->product_name;
        $min_qty = $request->min_qty;
        $max_qty = $request->max_qty;  

        $product_price = $request->product_price;
        $sku = $request->sku;
        $stock_status = $request->stock_status;
        $discount = $request->discount;
        $discount_type = $request->discount_type;
        $product_description = $request->product_description;
        $meta_title = $request->meta_title;
        $meta_description = $request->meta_description;
        $slug = $request->slug;
        $product_status = $request->product_status;
        $product_brand = $request->product_brand; 
        $main_categories = collect($request->main_categories)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all();  
        $sub_categories = collect($request->sub_categories)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 

        $newProduct = Product::create([
            'product_name' => $product_name,
            'min_purchase_qty' => $min_qty,
            'max_purchase_qty' => $max_qty,  
            'regular_price' => $product_price,
            'sku' => $sku,
            'stock_status' => $stock_status,
            'discount' => $discount,
            'discount_type' => $discount_type,
            'product_description' => $product_description,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'slug' => $slug,
            'product_status' => $product_status,
            'brand' => $product_brand,
            'main_category' => $main_categories,
            'sub_category' => $sub_categories
        ]); 
        $newProductId = $newProduct->id; 
        $images = $request->file('product_images'); 
        if ($images) {
            $productFolderPath = 'assets/backend/upload/products/';
            $storedImages = []; 
            foreach ($images as $key => $image) {
                $imageName = $key.'_'.time() . '.' . $image->getClientOriginalExtension(); 
                $image->move(public_path($productFolderPath), $imageName); 
                $storedImages[] = $productFolderPath . $imageName;
            }
            $imagesString = implode(',', $storedImages);
            Product::where('id', $newProductId)->update([
                'product_images' => json_encode($storedImages, JSON_UNESCAPED_SLASHES)
            ]);
        }

          

    }


    public function test(Request $request){
        $formData = $request->all();
        return $formData;
    }

}
