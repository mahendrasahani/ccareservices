<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Backend\Stock;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.order.index', compact('orders'));
    }

    public function edit($id){
        $order = Order::with(['getOrderProduct:order_id,product_name,quantity,price,month,total_price,product_id,option_id,option_value_id', 'getOrderProduct.getProduct:id,product_images'])->where('id', $id)->first(); 
        // return $order;
        return view('backend.order.edit', compact('order')); 
    }

    public function update(Request $request, $id){
        $payment_status = $request->payment_status;
        $order_status = $request->order_status;
        $discount = $request->discount; 
        Order::where('id', $id)->update([
            "payment_status" => $payment_status,
            "order_status" => $order_status,
            "promo_discount" => $discount
        ]); 
        return redirect()->route('backend.order.index')->with('order_updated', "Order has been updated!");

    }


    public function placeOrder(Request $request){
        $payment_mode = $request->paymentMethod;
        if($payment_mode == 'cash_on_delivery'){ 
            $shipping_charge = Session::get('shipping_charge');
            $cart_items = Cart::with('getProduct:id,product_name')->where('user_id', Auth::user()->id)->get();
            $sub_total = 0;
            foreach ($cart_items as $item) {
                $sub_total += $item->price*$item->quantity;
            }
            $total = $sub_total + $shipping_charge;
            $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
            $latest_order = Order::latest()->first();
            $new_order_id = $latest_order ? substr($latest_order->order_id, 3) + 1 : 1000001;
           $new_order_id = Order::create([
                    "user_id" => Auth::user()->id,
                    "order_id" => 'CCS'.$new_order_id,
                    "payment_mode" => $request->paymentMethod,
                    "delivery_charge" => $shipping_charge, 
                    "sub_total" => $sub_total,
                    "total" => $total, 
                    "billing_name" => $billing_address->name,
                    "shipping_name" => $shipping_address->name,
                    "billing_email" => $billing_address->email,
                    "shipping_email" => $shipping_address->email,
                    "payment_method" => "cash_on_delivery",
                    "tax" => 0,
                    "payment_status" => "unpaid",
                    "order_status" => "ordered", 
                    "shipping_address" =>  $shipping_address->address.' '.$shipping_address->city.' '.$shipping_address->zip_code.' '.$shipping_address->country,
                    "billing_address" =>  $billing_address->address.' '.$billing_address->city.' '.$billing_address->zip_code.' '.$billing_address->country,
                    "status" => 1
                    ])->id; 

                foreach ($cart_items as $item) { 
                    $option_value = AttributeValue::where('id', $item->option_value_id)->first();
                    $option = Attribute::where('id', $item->option_id)->first();

                    OrderProduct::create([
                        "user_id" => Auth::user()->id,
                        "order_id" => $new_order_id,
                        "product_id" => $item->product_id,
                        "product_name" => $item->getProduct->product_name,
                        "quantity" => $item->quantity,
                        "price" => $item->price,
                        "month" => $item->month,
                        "option_id" => $option->name,
                        "option_value_id" => $option_value->name,
                        "total_price" => $item->price * $item->quantity,
                        "stock_id" => $item->stock_id
                    ]); 
                    $stock_item = Stock::findOrFail($item->stock_id);
                    if ($stock_item->quantity >= $item->quantity) { 
                        $stock_item->quantity -= $item->quantity; 
                        $stock_item->save(); 
                    } 
                } 
                Session::forget('delivery_charge');
                $cart_items = Cart::with('getProduct:id,product_name')->where('user_id', Auth::user()->id)->delete(); 
                $enc_order_id = Crypt::encryptString($new_order_id);
                return redirect('/order-detail/'.$enc_order_id);
              
            }
            // code for order with payment gateways -------------------------------------------------------------------------------------------------
            else{

            }
            // code for order with payment gateways -----------------------------------------------------------------------------------------
    } 
    public function purchaseHistory(){
        $data['purchase_history'] = Order::with('getOrderProduct:order_id,product_name')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get(); 
        // return $data;
        return view('frontend.account.purchase_history', $data);
    }

    public function orderDetail($id){
        try{
        $order_id = Crypt::decryptString($id);
        $order = Order::with('getOrderProduct:order_id,product_id,product_name,price,total_price,quantity', 'getOrderProduct.getProduct:id,product_name,product_images')->findOrFail($order_id);
        }catch(\Exception $e){
            abort(404);
        }
        // return $order;
        return view('frontend.account.order_detail', compact('order'));
    }
}
