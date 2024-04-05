<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\DeliveryBoy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyController extends Controller
{
    public function index(){ 
        $delivery_boy_list = DeliveryBoy::orderBy('id', 'desc')->paginate(10);
        return view('backend.delivery_boy.index', compact('delivery_boy_list'));
    }

    public function create(){
        return view('backend.delivery_boy.create', );
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email'],
            'phone' => ['required'],
        ]); 
        $user = DeliveryBoy::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
            'father_name' => $request->father_name, 
            'aadhar_number' => $request->aadhar_number, 
            'status' => 1  
        ]);
        return redirect()->route('backend.delivery_boy.index')->with('created', 'Delivery boy has been created !');

    }


    public function edit($id){
        $delivery_boy = DeliveryBoy::where('id', $id)->first();
        return view('backend.delivery_boy.edit', compact('delivery_boy'));
    }

    public function update(Request $request, $id){
        DeliveryBoy::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
            'father_name' => $request->father_name, 
            'aadhar_number' => $request->aadhar_number, 
            'status' => 1  
        ]);
        return redirect()->route('backend.delivery_boy.index')->with('updated', 'Delivery boy has been updated !');
    }

}
