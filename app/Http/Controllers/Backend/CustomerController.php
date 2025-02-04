<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function index(){
        $customers_list = User::with(['getShippingAddress', 'getUserOrder'])
        ->withCount('getUserOrder')
        ->where('user_type', 2)->orderBy('id', 'desc')->paginate(10);
        // return $customers_list;
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
            "aadhar_front" => ['required', 'mimes:jpg,png,pdf,jpeg'],
            "aadhar_back" => ['required', 'mimes:jpg,png,pdf,jpeg'],
            "security_check" => ['required', 'mimes:jpg,png,pdf,jpeg'],
        ]);
        $otp = random_int(1000, 9999); 
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('CC_'.$request->email), 
            'user_type' => 2,
            'otp_verify_status' => 1,
            'phone' => $request->phone, 
        ]);
    
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
            


    }

    public function view($id){
        $customer = User::with(['getShippingAddress', 'getUserOrder', 'getCartItem'])->where('user_type', 2)->where('id', $id)
        ->withCount('getUserOrder') 
        ->withCount('getCartItem') 
        ->withSum('getUserOrder', 'total') 
        ->withSum('getUserOrder', 'promo_discount') 

        ->first();
        // return $customer;
        return view('backend.customer.view', compact('customer'));
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

}
