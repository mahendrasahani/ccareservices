<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
      $vendor_list = Vendor::get();
       return view('backend.vendor.index', compact('vendor_list')) ;
    }

    public function create(){
        return view('backend.vendor.create') ;
     }
    public function edit(){
        return view('backend.vendor.edit') ;
     } 

     public function store(Request $request){
         $validated = $request->validate([
            "vendor_name" => 'required',
            "vendor_email" => 'required',
            "vendor_phone" => 'required',
            "business_name" => 'required',
            "vendor_address" => 'required',
            "vendor_image" => 'required',
         ]);


         try{
            Vendor::create([
               "name" => $request->vendor_name,
               "profile_image" => '',
               "business_name" => $request->business_name,
               "email" => $request->vendor_email,
               "phone" => $request->vendor_phone,
               "address" => $request->vendor_address
            ]); 
         }catch(\Exception $e){
           return 'Something went wrong';
         }


         return redirect()->back()->with('vendor_created', "Vendor has been created syccessfully !");
     }
    
}
