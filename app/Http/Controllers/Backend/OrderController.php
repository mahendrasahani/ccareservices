<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
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
            $new_order_id = $latest_order ? $latest_order->order_id + 1 : 1;
           $new_order_id = Order::create([
                    "user_id" => Auth::user()->id,
                    "order_id" => $new_order_id,
                    "payment_mode" => $request->paymentMethod,
                    "delivery_charge" => $shipping_charge, 
                    "sub_total" => $sub_total,
                    "total" => $total,
                    "shipping_address" =>  $shipping_address->address.' '.$shipping_address->city.' '.$shipping_address->zip_code.' '.$shipping_address->country,
                    "billing_address" =>  $billing_address->address.' '.$billing_address->city.' '.$billing_address->zip_code.' '.$billing_address->country,
                ])->id; 

                foreach ($cart_items as $item) { 
                    OrderProduct::create([
                        "user_id" => Auth::user()->id,
                        "order_id" => $new_order_id,
                        "product_id" => $item->product_id,
                        "product_name" => $item->getProduct->product_name,
                        "quantity" => $item->quantity,
                        "price" => $item->price,
                        "month" => $item->month,
                        "total_price" => $item->price * $item->month 
                    ]);
                } 
                Session::forget('delivery_charge');
                $cart_items = Cart::with('getProduct:id,product_name')->where('user_id', Auth::user()->id)->delete(); 
                return redirect('/dashboard');
            }
            // code for order with payment gateways -------------------------------------------------------------------------------------------------
            else{

            }
            // code for order with payment gateways -----------------------------------------------------------------------------------------

    }
}
