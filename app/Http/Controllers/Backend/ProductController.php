<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\Brand;
use App\Models\Backend\MainCategory;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\Review;
use App\Models\Backend\ShippingCharge;
use App\Models\Backend\Stock;
use App\Models\Backend\SubCategory;
use App\Models\Backend\Tax;
use App\Models\Frontend\Cart;
use Auth;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
 
use Illuminate\Support\Facades\Session;
use Str;

class ProductController extends Controller
{
    public function index(){ 
        $product_list = Product::select('*')->withAvg('getReview', 'rating');
        if(isset($_GET['sortBy']) && $_GET['sortBy'] != ''){
            if($_GET['sortBy'] == 'price_high_to_low'){
                $product_list = $product_list->orderBy('regular_price', 'desc');
            }elseif($_GET['sortBy'] == 'price_low_to_high'){
                $product_list = $product_list->orderBy('regular_price', 'asc');
            }
        }else{
            $product_list = $product_list->orderBy('id', 'desc');
        } 
        $product_list = $product_list->with('getBrand')->paginate(10); 
        $product_list->appends([
            'sortBy' => isset($_GET['sortBy']) ? $_GET['sortBy'] : '',
            'page' => isset($_GET['page']) ? $_GET['page'] : '',
        ]); 
        return view('backend.product.index', compact('product_list'));
    }

    public function create(){  
        $brand_list = Brand::where('status', 1)->get();
        $main_category_list = MainCategory::with('subCategory')->where('status', 1)->get();
        $attribute_list = Attribute::where('status', 1)->get();
        $tax_rates = Tax::where('tax_rate', '>', 0)->where('status', 1)->get(); 
        return view('backend.product.create', compact('brand_list', 'main_category_list', 
        'tax_rates', 'attribute_list'));
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
        $tax = $request->tax;  
        $tax_data = Tax::where('id', $tax)->first();
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
            'min_purchase_qty' => 1,
            'max_purchase_qty' => 1,   
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
            'attribute_value' => $request->filtering_attributes,
            'tax_id' => $tax_data->id,
            'tax_name' => $tax_data->tax_name,
            'tax_rate' => $tax_data->tax_rate,
        ]); 
        $newProductId = $newProduct->id; 
        $imagePaths = []; 
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $image) {
                $fileStorePath = 'assets/backend/upload/products'; 
                $fileName = $key . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($fileStorePath), $fileName); 
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
        try{ 
            $tax_rates = Tax::where('tax_rate', '>', 0)->where('status', 1)->get(); 
            $product_detail = Product::select('*')->with('getStock')->where('id', $id)->first(); 
            $brand_list = Brand::where('status', 1)->get(); 
            $main_category_list = MainCategory::where('status', 1)->get();
            $attribute_list = Attribute::where('status', 1)->get();  
            // $taxes = Tax::where('status', 1)->get();
            // $option_name = Attribute::where('id', $product_detail->get_stock->attribute_id)->first()->name;
            return view('backend.product.edit', compact('product_detail', 'brand_list', 'main_category_list', 'attribute_list', 'tax_rates'));
        }catch(\Exception $e){
            return "something went wrong";
        }
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
            $tax = $request->tax;  
            $tax_data = Tax::where('id', $tax)->first();
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
                'attribute_value' => $request->filtering_attributes,
                'tax_id' => $tax_data->id,
                'tax_name' => $tax_data->tax_name,
                'tax_rate' => $tax_data->tax_rate,
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

            // $taxes = $request->tax;
            // $tax_name = [];
            // $tax_rates = [];
            // foreach($taxes as $tax){
            //     $tax = Tax::where('id', $tax)->first();
            //     $tax_name[] = $tax->tax_name;
            //     $tax_rates[] = $tax->tax_rate;
            // }
            // Product::where('id', $id)->update([
            //     "tax_name" => json_encode($tax_name, JSON_UNESCAPED_SLASHES),
            //     "tax_rate" => json_encode($tax_rates, JSON_UNESCAPED_SLASHES)
            // ]);
 
            return response()->json([
                "status" => 200,
                "message" => "success"
            ]);  
        }


        public function view($id){
            $product_detail = Product::where('id', $id)->with('getBrand')->first();
            $review_count = Review::where('product_id', $id)->count();
            $cart_count = Cart::where('product_id', $id)->count();
            $time_sold = OrderProduct::where('product_id', $id)->count();
            return view('backend.product.view', compact('product_detail', 'review_count', 'cart_count', 'time_sold'));
        }

        public function clone(Request $request){ 
            $id = $request->id;
            $task = Product::find($id);
            $new = $task->replicate();
            $new->save(); 
            $newId = $new->id;
            $new_product = Product::where('id', $newId)->with('getBrand')->orderBy('id', 'desc')->first(); 
            $main_cat = MainCategory::whereIn('id', $new_product->main_category)->get();
            return response()->json([
                "status" => 200,
                "message" => "success",
                "new_product" => $new_product,
                "main_cat" => $main_cat
            ]);  
        }

        public function destroy(Request $request){
            $id = $request->id;
            $product = Product::find($id);
            $delete_result = $product->delete();
            if($delete_result){
                return response()->json([
                    'status' => 200,
                    'message' => 'success'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'failed'
                ]);
            }
        }


        public function changeStatus(Request $request){
            $product_id = $request->product_id;
            $product_status = $request->product_status;
            Product::where('id', $product_id)->update([
                'product_status' => $product_status
            ]);
            return response()->json([
                'status' => 200,
                'message' => "success"
            ]);
        }

        public function multiDestroy(Request $request){
            $ids = $request->selectedIds;
            $delete_result = Product::whereIn('id', $ids)->delete();
            if($delete_result){
            return response()->json([
                "status" => 200,
                "message" => "success"
            ]);
            }else{
                return response()->json([
                    "status" => 400,
                    "message" => "faild"
                ]);
            }
        }


        public function search(Request $request){
            $search_val = $request->search_val;
            if($search_val != ''){
                $search_result = Product::with('getBrand')->where('product_name', 'LIKE', '%'.$search_val.'%')->get();
            }else{
                $search_result = Product::with('getBrand')->orderBy('id', 'desc')->paginate(10);
            }
            $html = '';
            $count = 1;
            if($search_result->count() == 0){
                $html .= '<tr>';
                $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
                $html .= '</td>';
                $html .= '</tr>';
            }else{
                foreach($search_result as $search_data){ 
                    $html .= '';
                    $html .= '<tr id="row_id_'.$search_data->id.'">';
                    $html .= '<td style="display: table-cell;">';
                    $html .= '<div class="form-group">';
                    $html .= '<div class="form-check-inline">';
                    $html .= '<input type="checkbox" class="form-check-input check-one" name="product_ids[]" value="'.$search_data->id.'">';
                    $html .= '<label class="form-check-label"></label>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '<td style="display: table-cell;">';
                    $html .= '<a href="" target="_blank" class="text-reset d-block">';
                    $html .= '<div class="d-flex align-items-center">';
                    $html .= '<a href="#" target="_blank" class="">';
                    $html .= '<div class="d-flex align-items-center">';
                    $html .= '<img src="'.($search_data->product_images == null ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$search_data->product_images[0])).'" width="50%">';
                    $html .= '<span class="flex-grow-1 minw-0">';
                    $html .= '<div class=" text-truncate-2">';
                    $html .= '<p class="font-s">'.$search_data->product_name.'</p>';
                    $html .= '</div>';
                    $html .= '</span>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</td>';
                    $html .= '<td style="display: table-cell;">';
                    $html .= '<div>';
                    $html .= '<div>';
                    $html .= '<span>Rating</span>: <span class="rating rating-sm my-2"><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i></span>';
                    $html .= '</div>'; 
                    $html .= '<div>';
                    $html .= '<span>Price</span>: <span class="fw-600">₹<strike>'.number_format($search_data->regular_price, 2).'</strike></span>';
                    if($search_data->discount_type == 'flat'){
                    $html .= '<span>Price</span>: <span class="fw-600">₹'.number_format($search_data->regular_price - $search_data->discount, 2).'</span>';
                    }
                    elseif($search_data->discount_type == 'percent'){
                    $html .= '<span>Price</span>: <span class="fw-600">₹'.number_format($search_data->regular_price - ($search_data->regular_price * $search_data->discount)/100, 2).'</span>';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</td>';                                     
                    $html .= '<td style="display: table-cell;">'; 
                    $main_cat = MainCategory::whereIn('id', $search_data->main_category)->get();
                    foreach($main_cat as $main){
                    $html .= '<span class="badge badge-primary mb-1">'.$main->name.'</span>';
                    }
                    $html .= '</td>';
                    $html .= '<td>';
                    $html .= '<div class="h-50px w-100px d-flex align-items-center justify-content-center">';
                    $html .= '<img src="'.($search_data->getBrand->logo == '' ? url('public/assets/both/placeholder/brand.jpg') : url($search_data->getBrand->logo)).'" width="15%">';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '<td><label class="switch">';
                    $html .= '<input type="checkbox"'. ($search_data->product_status == 1 ? 'checked':'').' id="product_status" name="product_status" value="'.$search_data->product_status.'" data-id="'.$search_data->id.'">';
                    $html .= '<span class="slider"></span></label>';
                    $html .= '</td>';
                    $html .= '<td class="text-right footable-last-visible ">';
                    $html .= '<a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage"';
                    $html .= 'href="'.route('backend.product.view', [$search_data->id]).'" title="View">';
                    $html .= '<i class="fa-regular fa-eye"></i>';
                    $html .= '</a>';
                    $html .= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"';
                    $html .= 'href="'.route('backend.product.edit', [$search_data->id]).'" title="Edit">';
                    $html .= '<i class="fa-regular fa-pen-to-square text-white"></i>';
                    $html .= '</a>';                     
                    $html .= '<a class="btn btn-soft-success btn-icon btn-circle btn-sm eye_3"';
                    $html .= 'href="javascript:void()" title="Duplicate" onclick="cloneRow('.$search_data->id.')">';
                    $html .= '<i class="fa-regular fa-copy"></i>';
                    $html .= '</a> ';
                    $html .= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
                    $html .= '</td>';
                }
            }
            return $html;
        }


        public function productListFrontView(Request $request, $main_category, $sub_category = ''){
           try{ 
            $filter = (int)$request->filter;
            $main_cat_id = MainCategory::where('slug', $main_category)->first();
            $product_list = Product::select('*')->whereHas('getStock')->with('getStock');
            if($sub_category != ''){
            $sub_cat_row = SubCategory::where('slug', $sub_category)->first();
            $sub_cat_name = $sub_cat_row->name;
            if($filter != 0){
                $product_list = $product_list->whereJsonContains('sub_category', $filter);
            }else{
                $product_list = $product_list->whereJsonContains('sub_category', $sub_cat_row->id);
            }
            }
            if($sub_category == ''){
                $product_list = $product_list->whereJsonContains('main_category', $main_cat_id->id);
            }
            $product_list = $product_list->orderBy('id', 'desc')->paginate(12);
            $sub_cat_list = SubCategory::where('main_category_id', $main_cat_id->id)->get();
            $page_url = url('category/'.$main_category.'/'.$sub_category.'/');
            $main_category_name = $main_cat_id->name; 
            // return $product_list;
            return view('frontend.product.index', compact('product_list', 
            'main_category', 'sub_category', 'sub_cat_list', 'page_url', 'main_category_name', 'sub_cat_name', 'sub_cat_row')); 
        }catch(\Exception $e){
            abort('404');
        }
        }

        public function singleProductFrontView($slug){

            // $product_detail = Product::where('slug', $slug)->with('getStock')->first();
            $product_detail = Product::where('slug', $slug)
            ->with(['getStock' => function ($query) {
                $query->with('getAttrValue')->orderByRaw('(SELECT sort_order FROM attribute_values WHERE attribute_values.id = stocks.attribute_value_id) ASC');
            }])
            ->first();
            
            // return $product_detail;
            $option_id = $product_detail->getStock[0]->attribute_id;
            $option_name = Attribute::where('id', $option_id)->first()->name; 

            $review_data = Review::select('*');
            if(auth()->check()){
                $review_data = $review_data->where('user_id', Auth::user()->id);
                $review_data = $review_data->where('product_id', $product_detail->id)->first();
            }else{
                $review_data = $review_data->get();
            }

            $average_rating = Review::where('product_id', $product_detail->id)->avg('rating');
            $roundedRating = ceil($average_rating);  

            $all_review = Review::with('getUser')->where('product_id', $product_detail->id)->where('status', 1)->get();

            $review_count = Review::where('product_id', $product_detail->id)->count();
            return view('frontend.product.single_product', compact('product_detail', 'option_name', 'review_data', 'roundedRating', 'all_review', 'review_count'));
        }


        public function getOptionList(Request $request){
            $ids = $request->ids;
            $newOptionList = Attribute::whereIn('id', $ids)->get();
            return response()->json([
                "status" => 200,
                "message" => "success",
                "data" => $newOptionList
            ]);
        }


        
        public function getOptionValueList(Request $request){
            $id = $request->id;
            $OptionValueList = AttributeValue::where('attribute_id', $id)->get();
            return response()->json([
                "status" => 200,
                "message" => "success",
                "data" => $OptionValueList
            ]);
        }

        public function getMonthPrice(Request $request){ 
            $product_id = Crypt::decryptString($request->product_id);
            $option_value_id = $request->option_value_id;
            $data = Stock::where('product_id', $product_id)->where('attribute_value_id', $option_value_id)->first();
            if($data){
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $data,
                    'id' => $product_id
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'failed'
                ]);
            }
        }

        public function decryptProductId(Request $request){
            $encryptId = $request->encrypt_id;
            $decryptId = Crypt::decryptString($encryptId);
            return response()->json([
                "status" => 200,
                "message" => "success",
                "product_id" => $decryptId
            ]);
        }

        public function checkStock(Request $request){

            $product_id = Crypt::decryptString($request->product_id);
            $quantity = $request->quantity;
            $option_value_id = $request->option_value_id; 
            $stock_qty = Stock::where('product_id', $product_id)->where('attribute_value_id', $option_value_id)->first()->quantity;
            return response()->json([
                "status" => 200,
                "message" => "success",
                "quantity" => $stock_qty
            ]); 
        }


        function removeFromCart(Request $request){
            $product_id = $request->product_id; 
            if(Auth::check()){
                $remove_product = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->delete();
                $cart_item = Cart::where('user_id', Auth::user()->id)->count(); 
                if($remove_product){
                return response()->json([
                    "status" => 200,
                    "message" => "removed",
                    "cart_item" => $cart_item,
                ]);
            }
            }else{
                $cart = session()->get('cart'); 
                foreach ($cart as $key => $item) {
                    if ($item['product_id'] == $product_id) {
                        unset($cart[$key]);
                        break;
                    }
                }
                $cart = array_values($cart);
                session()->put('cart', $cart);
                return response()->json([
                    "status" => 200,
                    "message" => "removed",
                    "cart_item" => count($cart),
                    'product_id' => $product_id
                ]);
                

            } 
        }

    public function productToCheckout(Request $request){
        // $shipping_charge = intval(Session::get('shipping_charge'));
        $user_id = Auth::user()->id;
        // $shipping_charge = ShippingCharge::where('id', $request->shipping_charge_id);
        $cart_item = Cart::with(['getProduct:id,product_name,tax_name,tax_rate','getStock'])
        ->whereHas('getStock', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->where('user_id', $user_id)->get(); 
                return response()->json([
                    "data"=>$cart_item, 
                ]); 
        }

        public function getTaxList(){
            $taxes = Tax::where('status', 1)->get();
            return response()->json([
                "data" => $taxes,
                "status" => "success"
            ], 200);
        }

}
