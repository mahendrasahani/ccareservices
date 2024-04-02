<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\PaymentMethod;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller{ 
    public function getAddressDetail(){
        $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
        $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
        $cart_item = Cart::with(['getProduct:id,product_name','getStock'])
        ->whereHas('getStock', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->where('user_id', Auth::user()->id)->get();
       
        $shipping_charge = Session::get('shipping_charge');
        return response()->json([
            "status" => 200,
            "message" => "success",
            "shipping_address" => $shipping_address,
            "billing_address" => $billing_address,
            "cart_data" => $cart_item,
            "shipping_charge" => $shipping_charge
        ]);
    } 



    public function index(){ 
        $cod = PaymentMethod::where('id', 1)->first();
        $razorpay = PaymentMethod::where('id', 2)->first();
        return view('backend.payment_method.index', compact('cod', 'razorpay'));
    }

    public function paymentMethods(){
        $payment_methods = PaymentMethod::where('status', 1)->get(); 
        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $payment_methods
        ], 200);
    }
 
    public function updateStatus(Request $request){
        try{
            $paymentMethodStatus = $request->paymentMethodStatus;
            $paymentMethodId = $request->paymentMethodId;
    
            PaymentMethod::where('id', $paymentMethodId)->update(['status' => $paymentMethodStatus]);
            return response()->json([
                "status" => 200,
                "message" => "success", 
                "paymentMethodStatus" => $paymentMethodStatus,
                "paymentMethodId" => $paymentMethodId
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "status" => 400,
                "message" => "something_went_wrong", 
                "error" => $e->getMessage(), 
            ], 400);
        }
       
    }

    public function updateRazorpayCredentials(Request $request, $id){
        $razorpay_key = $request->razorpay_key;
        $razorpay_secret = $request->razorpay_secret;

        PaymentMethod::where('id', $id)->update([
            "key" => $razorpay_key,
            "secret" => $razorpay_secret
        ]);
        return redirect()->back()->with('credentials_updated', "Razorpay Credentials has benn updated !");
    }



}