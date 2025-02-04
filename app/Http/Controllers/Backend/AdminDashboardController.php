<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\Product;
use App\Models\Backend\ProductReturn;
use App\Models\Backend\RecentActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboardPageView(){
        $total_customers = User::where('user_type', 2)->count();
        $total_order = Order::where('status', 1)->count();
        $total_sales = Order::where('status', 1)->where('order_status', 'delivered')->sum('total');
        $total_product = Product::count(); 
        $latest_order = Order::orderBy('id', 'desc')->paginate(5);
        $return_order = ProductReturn::orderBy('id', 'desc')->get();
        $todays_recent_activity = RecentActivity::whereDate('created_at', now()->toDateString())->count();

        return view('backend.dashboard.index', compact('total_customers', 'total_order', 'total_sales', 'total_product',
        'latest_order', 'return_order', 'todays_recent_activity'));
    }

    public function adminLogin(){
        return view('auth.admin_login');
    }

    public function editAdminProfile(){
        $profile = User::where('id', Auth::user()->id)->first();
        return view('backend.profile.edit_admin_profile', compact('profile'));
    }


    public function updateAdminProfile(Request $request){ 
        try{
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

              return redirect()->back()->with('profile_updated', 'Your profile has been updated successfully !');
        }catch(\Exception $e){
            return $e->getMessage();
        }
        



    }
}
