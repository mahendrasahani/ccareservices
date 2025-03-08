<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function index(){
        $shipping_charges_list = ShippingCharge::all();
        return view('backend.shipping_charge.index', compact('shipping_charges_list'));
    }

    public function store(Request $request){
        $name = $request->name;
        $amount = $request->amount;  
        ShippingCharge::create([
            "name" => $name,
            "amount" => $amount,
            "status" => 1
        ]); 
        return redirect()->back()->with('added', 'Shipping Charges has been added!');
    }

    public function changeStatus(Request $request){
        $shipping_charge_id = $request->shipping_charge_id;
        $status = $request->shipping_charge_status; 

        if($shipping_charge_id == 1 && $status == 0){
            //make 2 enable and make 1 disable
            ShippingCharge::where('id', 1)->update([
                "status" => 0
            ]); 
            ShippingCharge::where('id', 2)->update([
                "status" => 1
            ]); 
        }else if($shipping_charge_id == 1 && $status == 1){
            // make 2 disable and make 1 enable
            ShippingCharge::where('id', 1)->update([
                "status" => 1
            ]); 
            ShippingCharge::where('id', 2)->update([
                "status" => 0
            ]); 
        }else if($shipping_charge_id == 2 && $status == 0){
            // make 1 enable and make 2 disable
            ShippingCharge::where('id', 1)->update([
                "status" => 1
            ]); 
            ShippingCharge::where('id', 2)->update([
                "status" => 0
            ]); 
        }else if($shipping_charge_id == 2 && $status == 1){
            // make 2 enable and make 1 disable
            ShippingCharge::where('id', 1)->update([
                "status" => 0
            ]); 
            ShippingCharge::where('id', 2)->update([
                "status" => 1
            ]); 
        } 
        return response()->json([
            'status' => 200,
            'message' => "success"
        ]);
    }

    public function edit($id){
        $shipping_charge = ShippingCharge::where('id', $id)->first();
        if($shipping_charge->id == 1){
            return redirect()->back();
        }else{
            return view('backend.shipping_charge.edit', compact('shipping_charge'));
        }
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            "name" => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            "amount" => ['required', 'numeric'], 
        ]);
        $name = $request->name;
        $amount = $request->amount;
        ShippingCharge::where('id', $id)->update([
            "name" => $name,
            "amount" => $amount
        ]);
        return redirect()->route('backend.shipping_charge.index')->with('updated', "Shipping charge has been updated !");
    }

    public function destroy(Request $request){
        $id = $request->id;
        $shipping_charge = ShippingCharge::find($id);
        $delete_result = $shipping_charge->delete();
        return redirect()->route('backend.shipping_charge.index')->with('deleted', "Shipping charge has been deleted !");
    }
}
