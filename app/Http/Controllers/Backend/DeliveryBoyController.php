<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyController extends Controller
{
    public function index(){ 
        $delivery_boy_list = User::where('user_type', 3)->orderBy('id', 'desc')->paginate(10);
        return view('backend.delivery_boy.index', compact('delivery_boy_list'));
    }

    public function create(){
        return view('backend.delivery_boy.create', );
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 3,
            'status' => 1
        ]);
        return redirect()->route('backend.delivery_boy.index');
    }


}
