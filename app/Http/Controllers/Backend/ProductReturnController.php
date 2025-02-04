<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ProductReturn;
use App\Models\Backend\Stock;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function index(){ 

        $return_products = ProductReturn::select('*');
        if(isset($_GET['sort_by']) && $_GET['sort_by'] != ''){ 
            $return_products = $return_products->orderBy('created_at', $_GET['sort_by']);
        }else{
            $return_products = $return_products->orderBy('id', 'desc');
        }
        $return_products = $return_products->get();
        return view('backend.return.index', compact('return_products'));
    }
    public function edit($id){
        $orders = Order::orderBy('id', 'desc')->get(); 
        $return_data = ProductReturn::where('id', $id)->first();
        $order_product_list = OrderProduct::where('order_id', $return_data->order_id)->get();
        return view('backend.return.edit', compact('return_data', 'orders', 'order_product_list'));
    }
    public function view(){
        return view('backend.return.view');
    }
    public function create(){
        $orders = Order::orderBy('id', 'desc')->get(); 
        return view('backend.return.create', compact('orders'));
    }

    public function store(Request $request){ 
        $order_id = $request->order_id;
        $user_id = $request->user_id;
        $product_id = $request->product;
        $order_number = $request->order_number;
        $customer_name = $request->name;
        $customer_email = $request->email;
        $customer_phone = $request->phone;
        $date_of_purchase = $request->date_of_purchase;
        $product_name = $request->product_name;
        $stock_id = $request->stock_id;
        $attribute_name = $request->attribute;
        $attribute_value_name = $request->attribute_value;
        $quantity = $request->quantity;
        $return_reson = $request->return_reson;
        $comment = $request->comment;
        $return_action = $request->return_action;

        if($return_action == 1){
            Stock::where('id', $stock_id)->increment("quantity", $quantity);
            ProductReturn::create([
                "order_id" => $order_id,
                "user_id" => $user_id,
                "product_id" => $product_id,
                "stock_id" => $stock_id,
                "order_number" => $order_number,
                "date_of_purchase" => $date_of_purchase,
                "customer_name" => $customer_name,
                "customer_email" => $customer_email,
                "customer_phone" => $customer_phone,
                "product_name" => $product_name,
                "attribute_name" => $attribute_name,
                "attribute_value_name" => $attribute_value_name,
                "quantity" => $quantity,
                "return_reson" => $return_reson,
                "comment" => $comment,
                "return_action" => $return_action,
            ]); 
            return redirect()->route('backend.return.index')->with("return_added", "Product return has been added !");
        }else{
            ProductReturn::create([
                "order_id" => $order_id,
                "user_id" => $user_id,
                "product_id" => $product_id,
                "stock_id" => $stock_id,
                "order_number" => $order_number,
                "date_of_purchase" => $date_of_purchase,
                "customer_name" => $customer_name,
                "customer_email" => $customer_email,
                "customer_phone" => $customer_phone,
                "product_name" => $product_name,
                "attribute_name" => $attribute_name,
                "attribute_value_name" => $attribute_value_name,
                "quantity" => $quantity,
                "return_reson" => $return_reson,
                "comment" => $comment,
                "return_action" => $return_action,
            ]); 
            return redirect()->route('backend.return.index')->with("return_added", "Product return has been added !");
        } 
        
    }

    public function update(Request $request, $id){
        $order_id = $request->order_id;
        $user_id = $request->user_id;
        $product_id = $request->product;
        $order_number = $request->order_number;
        $customer_name = $request->name;
        $customer_email = $request->email;
        $customer_phone = $request->phone;
        $date_of_purchase = $request->date_of_purchase;
        $product_name = $request->product_name;
        $stock_id = $request->stock_id;
        $attribute_name = $request->attribute;
        $attribute_value_name = $request->attribute_value;
        $quantity = $request->quantity;
        $return_reson = $request->return_reson;
        $comment = $request->comment;
        $return_action = $request->return_action;

        if($return_action == 1){
            // Stock::where('id', $stock_id)->increment("quantity", $quantity);
            ProductReturn::where('id', $id)->update([
                "order_id" => $order_id,
                "user_id" => $user_id,
                "product_id" => $product_id,
                "stock_id" => $stock_id,
                "order_number" => $order_number,
                "date_of_purchase" => $date_of_purchase,
                "customer_name" => $customer_name,
                "customer_email" => $customer_email,
                "customer_phone" => $customer_phone,
                "product_name" => $product_name,
                "attribute_name" => $attribute_name,
                "attribute_value_name" => $attribute_value_name,
                "quantity" => $quantity,
                "return_reson" => $return_reson,
                "comment" => $comment,
                "return_action" => $return_action,
            ]); 
            return redirect()->route('backend.return.index')->with("return_added", "Product return has been added !");
        }else{
            ProductReturn::create([
                "order_id" => $order_id,
                "user_id" => $user_id,
                "product_id" => $product_id,
                "stock_id" => $stock_id,
                "order_number" => $order_number,
                "date_of_purchase" => $date_of_purchase,
                "customer_name" => $customer_name,
                "customer_email" => $customer_email,
                "customer_phone" => $customer_phone,
                "product_name" => $product_name,
                "attribute_name" => $attribute_name,
                "attribute_value_name" => $attribute_value_name,
                "quantity" => $quantity,
                "return_reson" => $return_reson,
                "comment" => $comment,
                "return_action" => $return_action,
            ]); 
            return redirect()->route('backend.return.index')->with("return_updated", "Product return has been updated !");
        } 
    }

 
    public function getOrderDetail(Request $request){ 
        try{
            $order_id = $request->order_id;
            $order = Order::where('id', $order_id)->first();
            return response()->json([
                "message" => "success",
                "order" => $order
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "message" => "something_went_wrong",
                "error" => $e->getMessage()
            ], 400);
        } 
    }

     
    public function getProductListFromOrder(Request $request){ 
        try{
            $order_id = $request->order_id;
            $order_product = OrderProduct::where('order_id', $order_id)->get();
            return response()->json([
                "message" => "success",
                "order_product" => $order_product
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "message" => "something_went_wrong",
                "error" => $e->getMessage()
            ], 400);
        } 
    }

    public function getOneProductFromOrder(Request $request){
        try{ 
            $order_product_id = $request->order_product;
            $product_id = $request->product_id;
            $order_product = OrderProduct::where('order_id', $order_product_id)->where('product_id', $product_id)->first();
            return response()->json([
                "message" => "success",
                "single_order_product" => $order_product
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "message" => "something_went_wrong",
                "error" => $e->getMessage()
            ], 400);
        } 

    }


    // ------------------------------------------------------------------------------------------
    public function search(Request $request){
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = ProductReturn::where('product_name', 'like', '%'.$search_val.'%')
            ->orWhere('customer_name', 'like', '%'.$search_val.'%')
            ->orWhere('order_number', 'like', '%'.$search_val.'%')
            ->get();
        }else{
            $search_result = ProductReturn::orderBy('id', 'desc')->paginate(10);
        }
 
        $html = '';
        $count = 1;
        if($search_result->count() == 0){
            $html .= '<tr>';
            $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
            $html .= '</td>';
            $html .= '</tr>';
        }else{
            foreach($search_result as $index => $search_data){
                $html .= '';
                $html .= '<tr id="row_id_1">';
                $html .= '<td style="display: table-cell;">';
                $html .= '<div class=" text-truncate-2">';
                $html .= '<p class="font-s mt-3">'.$search_data->order_number.'</p>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->customer_name.'</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->product_name.'</td>  ';
                $html .= '<td style="display: table-cell;">'.\Carbon\Carbon::parse($search_data->created_at)->format('d M, Y').'</td>';
                $html .= '<td style="display: table-cell;">';
                $html .= '<div class="d-flex justify-content-center">';
                $html .= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="'.route('backend.return.edit', [$search_data->id]).'" title="Edit">';
                $html .= '<i class="fa-regular fa-pen-to-square text-white"></i>';
                $html .= '</a>  ';
                $html .= '</div>';
                $html .= '</td> ';
                $html .= '</tr>';
            }
        }
        return $html;
     } 
// ------------------------------------------------------------------------------------------

 
}
