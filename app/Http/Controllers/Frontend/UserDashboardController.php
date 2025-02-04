<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller{
    public function userDashboardPageView(){
        $total_products_in_cart = Cart::where('user_id', Auth::user()->id)->count();
        $total_products_in_order_list = Order::where('user_id', Auth::user()->id)->count();
        $recent_purchase_history = OrderProduct::with('getProduct:id,product_name,product_images')
        ->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
       $default_shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
    //    return $recent_purchase_history;

        return view('frontend.account.user_dashboard', compact('total_products_in_cart', 'total_products_in_order_list',
        'recent_purchase_history', 'default_shipping_address'));
    }

    public function manageProfilePageView(){
        $user_data = User::where('id', Auth::user()->id)->where('user_type', '!=', 3)->first();
        $shipping_addres = ShippingAddress::where('user_id', Auth::user()->id)->first();
        $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
        return view('frontend.account.manage_profile', compact('user_data', 'shipping_addres', 'billing_address'));
    }

    public function discountPageView(){
        return view('frontend.account.discount');
    }

    public function updateUserProfile(Request $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $company_name = $request->company_name;
        $address_1 = $request->address_1;
        $address_2 = $request->address_2;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $postal_code = $request->postal_code; 

        User::where('id', Auth::user()->id)->update([
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "company_name" => $company_name,
            "address_1" => $address_1,
            "address_2" => $address_2,
            "country" => $country,
            "state" => $state,
            "city" => $city,
            "postal_code" => $postal_code, 
        ]);

        if($request->hasFile('profile')){
            $directory = "assets/both/images/user_profile";
            $profile = $request->profile;
            $profile_name = time().'.'.$profile->getClientOriginalExtension();
            $profile->move(public_path($directory), $profile_name); 
            User::where('id', Auth::user()->id)->update([
                "profile" => "public/".$directory.'/'.$profile_name,
            ]);
        } 
      if($request->hasFile('aadhar_front')){
        $directory = "assets/both/images/aadhar_front";
        $aadhar_front = $request->aadhar_front;
        $aadhar_front_name = time().'.'.$aadhar_front->getClientOriginalExtension();
        $aadhar_front->move(public_path($directory), $aadhar_front_name);
        User::where('id', Auth::user()->id)->update([
            "aadhar_front" => "public/".$directory.'/'.$aadhar_front_name,
        ]);
      }
      if($request->hasFile('aadhar_back')){
        $directory = "assets/both/images/aadhar_back";
        $aadhar_back = $request->aadhar_back;
        $aadhar_back_name = time().'.'.$aadhar_back->getClientOriginalExtension();
        $aadhar_back->move(public_path($directory), $aadhar_back_name);
        User::where('id', Auth::user()->id)->update([
            "aadhar_back" => "public/".$directory.'/'.$aadhar_back_name,
        ]);
      }
      if($request->hasFile('company_id')){
        $directory = "assets/both/images/company_id";
        $company_id = $request->company_id;
        $company_id_name = time().'.'.$company_id->getClientOriginalExtension();
        $company_id->move(public_path($directory), $company_id_name);
        User::where('id', Auth::user()->id)->update([
            "company_id" => "public/".$directory.'/'.$company_id_name,
        ]);
      } 
        return redirect()->back()->with('profile_updated', 'Profile has been updated successfully !');
    }
  
   
}
