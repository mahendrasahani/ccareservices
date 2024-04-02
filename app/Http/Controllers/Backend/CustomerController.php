<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers_list = User::with(['getShippingAddress', 'getUserOrder'])
        ->withCount('getUserOrder')
        ->where('user_type', 2)->paginate(10);
        // return $customers_list;
        return view('backend.customer.index', compact('customers_list'));
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

}
