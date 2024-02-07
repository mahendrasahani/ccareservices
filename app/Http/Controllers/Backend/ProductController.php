<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\Brand;
use App\Models\Backend\MainCategory;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Str;

class ProductController extends Controller
{
    public function index(){
        $product_list = Product::with('getBrand')->orderBy('id', 'desc')->paginate(10); 
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

        $attribute_name = collect($request->product_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 
        // $attribute_value = collect($request->filtering_attributes)->map(function ($value) {
        //     return intval(trim($value, '"'));
        // })->all(); 

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
            'slug' => $slug == '' ? Str::slug($product_name) : Str::slug($slug),
            'product_status' => $product_status,
            'brand' => $product_brand,
            'main_category' => $main_categories,    
            'sub_category' => $sub_categories,
            'attribute_name' => $attribute_name,
            'attribute_value' => $request->filtering_attributes
        ]); 
        $newProductId = $newProduct->id; 
        $imagePaths = []; 
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $image) {
                $fileStorePath = 'assets/backend/upload/products'; 
                // Generate a unique filename for each image
                $fileName = $key . '_' . time() . '.' . $image->getClientOriginalExtension(); 
                // Move the image to the specified directory
                $image->move(public_path($fileStorePath), $fileName); 
                // Store the image path in the array
                $imagePaths[] = $fileStorePath . '/' . $fileName;
            }
            Product::where('id', $newProductId)->update([
                'product_images' => json_encode($imagePaths, JSON_UNESCAPED_SLASHES)
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "success"
        ]);  
    }

        public function edit($id){
            $product_detail = Product::where('id', $id)->first();
            $brand_list = Brand::where('status', 1)->get();
            $main_category_list = MainCategory::where('status', 1)->get();
            return view('backend.product.edit', compact('product_detail', 'brand_list', 'main_category_list'));
        }

        public function update($id, Request $request){
        
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

            $attribute_name = collect($request->product_attributes)->map(function ($value) {
                return intval(trim($value, '"'));
            })->all(); 
            // $attribute_value = collect($request->filtering_attributes)->map(function ($value) {
            //     return intval(trim($value, '"'));
            // })->all(); 

            $newProduct = Product::where('id', $id)->update([
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
                'slug' => $slug == '' ? Str::slug($product_name) : Str::slug($slug),
                'product_status' => $product_status,
                'brand' => $product_brand,
                'main_category' => $main_categories,    
                'sub_category' => $sub_categories,
                'attribute_name' => $attribute_name,
                'attribute_value' => $request->filtering_attributes
            ]); 
            // $newProductId = $newProduct->id; 
            $imagePaths = []; 
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $key => $image) {
                    $fileStorePath = 'assets/backend/upload/products'; 
                    // Generate a unique filename for each image
                    $fileName = $key . '_' . time() . '.' . $image->getClientOriginalExtension(); 
                    // Move the image to the specified directory
                    $image->move(public_path($fileStorePath), $fileName); 
                    // Store the image path in the array
                    $imagePaths[] = $fileStorePath . '/' . $fileName;
                }
                Product::where('id', $id)->update([
                    'product_images' => json_encode($imagePaths, JSON_UNESCAPED_SLASHES)
                ]);
            }

            return response()->json([
                "status" => 200,
                "message" => "success"
            ]);  
        }


        public function view($id){
            $product_detail = Product::where('id', $id)->with('getBrand')->first();
            // return $product_detail;
            return view('backend.product.view', compact('product_detail'));
        }

}
