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
        $shipping_charge = $request->shipping_rate; 
       $s_name = $request->s_name;
       $s_email = $request->s_email;
       $s_phone = $request->s_phone;
       $s_address = $request->s_address;
       $s_city = $request->s_city;
       $s_zip_code = $request->s_zip_code;
       $s_country = $request->s_country;
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
            'country' => $s_country,
       ]; 
       $billing_detail = [
        'user_id' => Auth::user()->id,
        'name' => $b_name ?? $s_name,
        'email' => $b_email ?? $s_email,
        'phone' => $b_phone ?? $s_phone,
        'address' => $b_address ?? $s_address,
        'city' => $b_city ?? $s_city,
        'zip_code' => $b_zip_code ?? $s_zip_code,
        // 'country' => $b_country,
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

   public function redirectOnCart(){
    return redirect('/cart');
   }
}
