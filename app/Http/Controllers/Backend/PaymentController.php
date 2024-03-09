<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller{ 
    public function getAddressDetail(){
        $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
        $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
        $cart_item = Cart::with(['getProduct:id,product_name','getStock'])->where('user_id', Auth::user()->id)->get();
        return response()->json([
            "status" => 200,
            "message" => "success",
            "shipping_address" => $shipping_address,
            "billing_address" => $billing_address,
            "cart_data" => $cart_item
        ]);
    } 
 



}