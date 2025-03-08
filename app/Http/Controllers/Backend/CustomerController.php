<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class CustomerController extends Controller{
    public function index(){
        $customers_list = User::with(['getShippingAddress', 'getUserOrder'])
        ->withCount('getUserOrder')
        ->where('user_type', 2)->orderBy('id', 'desc')->paginate(10);
        return view('backend.customer.index', compact('customers_list'));
    }

    public function create(){
        return view('backend.customer.create');
    }

    public function store(Request $request){  
        $validate =$request->validate([
            "name" => ['required'],
            "email" => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            "phone" => ['required', 'numeric', 'digits:10', 'unique:'.User::class], 
            "shipping_address" => ['required'],
            "shipping_name" => ['required'],
            "shipping_email" => ['required', 'email', 'max:255'],
            "shipping_phone" => ['required', 'numeric', 'digits:10'],
            "shipping_city" => ['required'],
            "shipping_postal_code" => ['required', 'numeric'], 
            
            "billing_email" => ['email', 'max:255', 'nullable'], 
            "billing_phone" => ['numeric', 'digits:10', 'nullable'], 
            "billing_postal_code" => ['numeric', 'nullable'], 
            

            "aadhar_front" => ['mimes:jpg,png,pdf,jpeg'],
            "aadhar_back" => ['mimes:jpg,png,pdf,jpeg'],
            "security_check" => ['mimes:jpg,png,pdf,jpeg'],
        ]);
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone, 
                'password' => Hash::make('CC_JAI_SHREE_RAM'.$request->email.'DEVELOPERANILKUMAR'), 
                'user_type' => 2,
                'address_1' => $request->address,
                'city' => $request->city,
                'country' => 'India',
                'postal_code' => $request->postal_code, 
                'otp_verify_status' => 1,
            ]);
            ShippingAddress::create([
                "user_id" => $user->id,
                "name" => $request->shipping_name,
                "email" => $request->shipping_email,
                "phone" => $request->shipping_phone,
                "address" => $request->shipping_address,
                "city" => $request->shipping_city,
                "zip_code" => $request->shipping_postal_code,
                "country" => 'India'
            ]);

            if ($request->has('billing_detail_check')) {
            BillingAddress::create([
                "user_id" => $user->id,
                "name" => $request->billing_name,
                "email" => $request->billing_email,
                "phone" => $request->billing_phone,
                "address" => $request->billing_address,
                "city" => $request->billing_city,
                "zip_code" => $request->billing_postal_code,
                "country" => 'India'
            ]);
        }else{
            BillingAddress::create([
                "user_id" => $user->id,
                "name" => $request->shipping_name,
                "email" => $request->shipping_email,
                "phone" => $request->shipping_phone,
                "address" =>  $request->shipping_address,
                "city" => $request->shipping_city,
                "zip_code" => $request->shipping_postal_code,
                "country" => 'India'
            ]);
        }

            if($request->hasFile('aadhar_front')){
                $directory = "assets/both/images/aadhar_front";
                $aadhar_front = $request->aadhar_front;
                $aadhar_front_name = time().'.'.$aadhar_front->getClientOriginalExtension();
                $aadhar_front->move(public_path($directory), $aadhar_front_name);
                User::where('id', $user->id)->update([
                    "aadhar_front" => "public/".$directory.'/'.$aadhar_front_name,
                ]);
            }
            if($request->hasFile('aadhar_back')){
                $directory = "assets/both/images/aadhar_back";
                $aadhar_back = $request->aadhar_back;
                $aadhar_back_name = time().'.'.$aadhar_back->getClientOriginalExtension();
                $aadhar_back->move(public_path($directory), $aadhar_back_name);
                User::where('id', $user->id)->update([
                    "aadhar_back" => "public/".$directory.'/'.$aadhar_back_name,
                ]);
            }
            if($request->hasFile('security_cheque')){
                $directory = "assets/both/images/security_cheque";
                $security_cheque = $request->security_cheque;
                $security_cheque_name = time().'.'.$security_cheque->getClientOriginalExtension();
                $security_cheque->move(public_path($directory), $security_cheque_name);
                User::where('id', $user->id)->update([
                    "security_check" => "public/".$directory.'/'.$security_cheque_name,
                ]);
            } 
            return redirect()->route('backend.customer.index')->with('created', "Customer has been added");
        }catch(\Exception $e){
            return "Something went wrong. Please try again.";
        }
    }

    public function view($id){
        $customer = User::with(['getShippingAddress', 'getUserOrder', 'getCartItem'])->where('user_type', 2)->where('id', $id)
        ->withCount('getUserOrder') 
        ->withCount('getCartItem') 
        ->withSum('getUserOrder', 'total') 
        ->withSum('getUserOrder', 'promo_discount')  
        ->first(); 
        return view('backend.customer.view', compact('customer'));
    }

    public function edit($id){
        try{
            $user = User::where('id', $id)->first();
            $shipping_address = ShippingAddress::where('user_id', $user->id)->first();
            $billing_address = BillingAddress::where('user_id', $user->id)->first();
            return view('backend.customer.edit', compact('user', 'shipping_address', 'billing_address'));
        }catch(\Exception $e){
            abort('404');
        }
    }

    public function update(Request $request, $id){  
        $request->validate([
            "name" => ['required'],
            "email" => ['required', 'string', 'lowercase', 'email', Rule::unique('users', 'email')->ignore($id)],
            "phone" => ['required', 'numeric', 'digits:10', Rule::unique('users', 'phone')->ignore($id)],
            "shipping_address" => ['required'],
            "shipping_name" => ['required'],
            "shipping_email" => ['required'],
            "shipping_phone" => ['required', 'numeric', 'digits:10',],
            "shipping_city" => ['required'],
            "shipping_postal_code" => ['required'],  
        ]);
        try{
            User::where('id', $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                'address_1' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code
            ]);

            ShippingAddress::updateOrCreate(
                ["user_id" => $id],
                [
                    "name" => $request->shipping_name,
                    "email" => $request->shipping_email,
                    "phone" => $request->shipping_phone,
                    "address" => $request->shipping_address,
                    "city" => $request->shipping_city,
                    "zip_code" => $request->shipping_postal_code,
                    "country" => 'India'
                ]
            );
            
            if ($request->has('billing_detail_check')) {
                BillingAddress::updateOrCreate(
                    ['user_id' => $id],
                    [
                    "name" => $request->billing_name,
                    "email" => $request->billing_email,
                    "phone" => $request->billing_phone,
                    "address" => $request->billing_address,
                    "city" => $request->billing_city,
                    "zip_code" => $request->billing_postal_code,
                ]);
            }else{
                BillingAddress::updateOrCreate(
        ['user_id' => $id],
            [
                    "name" => $request->shipping_name,
                    "email" => $request->shipping_email,
                    "phone" => $request->shipping_phone,
                    "address" =>  $request->shipping_address,
                    "city" => $request->shipping_city,
                    "zip_code" => $request->shipping_postal_code,
                ]);
            }

            if($request->hasFile('aadhar_front')){
                $directory = "assets/both/images/aadhar_front";
                $aadhar_front = $request->aadhar_front;
                $aadhar_front_name = time().'.'.$aadhar_front->getClientOriginalExtension();
                $aadhar_front->move(public_path($directory), $aadhar_front_name);
                User::where('id', $id)->update([
                    "aadhar_front" => "public/".$directory.'/'.$aadhar_front_name,
                ]);
            }
            if($request->hasFile('aadhar_back')){
                $directory = "assets/both/images/aadhar_back";
                $aadhar_back = $request->aadhar_back;
                $aadhar_back_name = time().'.'.$aadhar_back->getClientOriginalExtension();
                $aadhar_back->move(public_path($directory), $aadhar_back_name);
                User::where('id', $id)->update([
                    "aadhar_back" => "public/".$directory.'/'.$aadhar_back_name,
                ]);
            }
            if($request->hasFile('security_cheque')){
                $directory = "assets/both/images/security_check";
                $security_cheque = $request->security_cheque;
                $security_cheque_name = time().'.'.$security_cheque->getClientOriginalExtension();
                $security_cheque->move(public_path($directory), $security_cheque_name);
                User::where('id', $id)->update([
                    "security_check" => "public/".$directory.'/'.$security_cheque_name,
                ]);
            }
            return redirect()->back()->with('upated', "Customer updated successfully.");
        }catch(\Exception $e){
            abort('404');
        }
    }

    public function updateActiveStatus(Request $request){
            try{
                User::where('id', $request->id)->update([
                'active_status' => $request->status
                ]);
                return response()->json([
                    "status" => "success", 
                    "message" => "status_changed"
                ], 200);
            }catch(\Exception $e){
                return response()->json([
                    "status" => "failed",
                    "error" => $e->getMessage()
                ], 400);
            }
    }

    // ------------------------------------------------------------------------------------------
    public function search(Request $request){
        try{
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = User::where('name', 'like', '%'.$search_val.'%')
            ->with(['getShippingAddress', 'getUserOrder'])
            ->withCount('getUserOrder')
            ->where('user_type', 2)->get();
        }else{
            $search_result = User::orderBy('id', 'desc')
            ->with(['getShippingAddress', 'getUserOrder'])
            ->withCount('getUserOrder')
            ->where('user_type', 2)->paginate(10);
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
                $html .= '<tr id="row_id_'.$search_data->id.'">';
                $html .= '<td>'.($index+1).'</td>';
                $html .= '<td>'.$search_data->name.'</td>';
                $html .= '<td>'.$search_data->email.'</td>';
                $html .= '<td>';
                if($search_data->getShippingAddress != ''){ 
                    $search_data->getShippingAddress->phone ?? '-';
                }
                $html .= '</td>';
                $html .= '<td>'.$search_data->get_user_order_count ?? ''.'</td>';
                $html .= '<td>';
                if($search_data->getShippingAddress != ''){ 
                    $search_data->getShippingAddress->address ?? '-';
                } 
                $html .= '</td>'; 
                $html .= '<td>';
                $html .= '<a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="'.route('backend.customer.view', [$search_data->id]).'" title="View"><i class="fa-regular fa-eye"></i></a>';
                $html .= '</td> ';
                $html .= '</tr>';
            }
        }
        return $html;
        }catch(\Exception $e){
        return $e->getMessage();
        }
    } 
    // ------------------------------------------------------------------------------------------

    public function allCustomersList(){
        try{
            $customers = User::where('user_type', 2)->where('active_status', 1)->get();
            return response()->json([
                "stauts" => "success",
                "no_of_records" => count($customers),
                "customers" => $customers
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "status" => "failed",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
