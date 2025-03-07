<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\ShippingAddress;
use App\Models\Backend\ShippingCharge;
use App\Models\Backend\Tax;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkoutPageView(){
         $cart_item = Cart::where('user_id', operator: Auth::user()->id)->get();
         if(count($cart_item) != 0){
        $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
        $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first(); 
        $paid_shipping_charges = ShippingCharge::where('status', 1)->where('id', '!=', 1)->get();  
        $free_shipping_charges = ShippingCharge::where('status', 1)->where('id', 1)->first();  
        $all_taxes = Tax::where('status', 1)->get();
        return view('frontend.checkout', compact('shipping_address', 'billing_address', 'free_shipping_charges',
        'paid_shipping_charges', 'all_taxes'));
         }else{
            return redirect('/cart');
         }
    }

    public function submitCheckoutAddress(Request $request){
        $validate = $request->validate([
            "s_name" => ['required'],
            "s_email" => ['required', 'email'],
            "s_phone" => ['required', 'numeric', 'digits:10'],
            "s_address" => ['required'],
            "s_city" => ['required'],
            "s_zip_code" => ['required', 'numeric']
        ]); 
        // "b_email" => ['sometimes', 'nullable', 'email'],
        // "b_phone" => ['sometimes', 'nullable', 'numeric', 'digits:10'], 
        // "b_address" => ['sometimes', 'nullable'],
        // "b_city" => ['sometimes', 'nullable'],
        // "b_zip_code" => ['sometimes', 'nullable', 'numeric'], 
        try{ 
            $shipping_charge = $request->shipping_rate; 
            $s_name = $request->s_name;
            $s_email = $request->s_email;
            $s_phone = $request->s_phone;
            $s_address = $request->s_address;
            $s_city = $request->s_city;
            $s_zip_code = $request->s_zip_code; 
            $both_address = $request->both_address;
            $b_name = $request->b_name;
            $b_email = $request->b_email;
            $b_phone = $request->b_phone;
            $b_address = $request->b_address;
            $b_city = $request->b_city;
            $b_zip_code = $request->b_zip_code; 
            ShippingAddress::updateOrCreate(
                ['user_id' => Auth::user()->id],
                [
                    "name" => $s_name,
                    "email" => $s_email,
                    "phone" => $s_phone,
                    "address" => $s_address,
                    "city" => $s_city,
                    "zip_code" => $s_zip_code,
                    "country" => 'India'
                ]
            ); 
            if ($request->has('billing_detail_check')) {
                BillingAddress::updateOrCreate(
                    ['user_id' => Auth::user()->id],
                    [
                        "name" => $b_name,
                        "email" => $b_email,
                        "phone" => $b_phone,
                        "address" => $b_address,
                        "city" => $b_city,
                        "zip_code" => $b_zip_code,
                        "country" => 'India'
                    ]
                ); 
            }else{
                BillingAddress::updateOrCreate(
                    ['user_id' => Auth::user()->id],
                    [
                        "name" => $s_name,
                        "email" => $s_email,
                        "phone" => $s_phone,
                        "address" => $s_address,
                        "city" => $s_city,
                        "zip_code" => $s_zip_code,
                        "country" => 'India'
                    ]
                );    
            } 
            Session::put('shipping_charge', $shipping_charge);
            return view('frontend.account.payment_method', compact('shipping_charge'));   
        }catch(\Exception $e){
            return response()->json([
                "status" => 400,
                "error" => "error in update address", 
            ]);
        }
    }


//submitCheckoutAddress2 function  Not in use this now
    public function submitCheckoutAddress2(Request $request){
        $shipping_charge = $request->shipping_rate; 
        $s_name = $request->s_name;
        $s_email = $request->s_email;
        $s_phone = $request->s_phone;
        $s_address = $request->s_address;
        $s_city = $request->s_city;
        $s_zip_code = $request->s_zip_code; 
        $both_address = $request->both_address;
        $b_name = $request->b_name;
        $b_email = $request->b_email;
        $b_phone = $request->b_phone;
        $b_address = $request->b_address;
        $b_city = $request->b_city;
        $b_zip_code = $request->b_zip_code;
    //    $b_country = $request->b_country; 
       $shipping_detail = [
        'user_id' => Auth::user()->id,
            'name' => $s_name,
            'email' => $s_email,
            'phone' => $s_phone,
            'address' => $s_address,
            'city' => $s_city,
            'zip_code' => $s_zip_code,
            'country' => 'India',
       ]; 
       $billing_detail = [
        'user_id' => Auth::user()->id,
        'name' => $b_name ?? $s_name,
        'email' => $b_email ?? $s_email,
        'phone' => $b_phone ?? $s_phone,
        'address' => $b_address ?? $s_address,
        'city' => $b_city ?? $s_city,
        'zip_code' => $b_zip_code ?? $s_zip_code,
        'country' => 'India',
       ];  
       $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
       $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();  
       if($shipping_address && $billing_address){ 
            if(!$both_address){
                try{
                ShippingAddress::where('user_id', Auth::user()->id)->update($shipping_detail);
                BillingAddress::where('user_id', Auth::user()->id)->update($billing_detail);
                }catch(\Exception $errror){
                    return response()->json([
                        "status" => 400,
                        "message" => "error in update address",
                        "cause" => $errror->getMessage()
                    ]);
                }
            }else{
                try{
                ShippingAddress::where('user_id', Auth::user()->id)->update($shipping_detail);
                BillingAddress::where('user_id', Auth::user()->id)->update($shipping_detail);
            }catch(\Exception $errror){
                return response()->json([
                    "status" => 400,
                    "message" => "error in update address",
                    "cause" => $errror->getMessage()
                ]);
            }
            }
       }else{
            if($both_address){
                try{
                    ShippingAddress::create($shipping_detail); 
                    BillingAddress::create($billing_detail);
                }catch(\Exception $errror){
                    return response()->json([
                        "status" => 400,
                        "message" => "error in update address",
                        "cause" => $errror->getMessage()
                    ]);
                }
            }else{
                try{
                ShippingAddress::create($shipping_detail);
                BillingAddress::create($shipping_detail);
            }catch(\Exception $errror){
                return response()->json([
                    "status" => 400,
                    "message" => "error in update address",
                    "cause" => $errror->getMessage()
                ]);
            }
            }
       }
       Session::put('shipping_charge', $shipping_charge);
        return view('frontend.account.payment_method', compact('shipping_charge'));  
    }
//submitCheckoutAddress2 function  Not in use this now


   public function redirectOnCart(){
    return redirect('/cart');
   }
}
