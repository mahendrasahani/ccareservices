<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Stock;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
      $vendor_list = Vendor::orderBy('id', 'desc')->paginate(10);
       return view('backend.vendor.index', compact('vendor_list')) ;
    }

    public function create(){
        return view('backend.vendor.create') ;
     }
    public function edit($id){
         $vendor = Vendor::where('id', $id)->first();

        return view('backend.vendor.edit', compact('vendor')) ;
     } 

     public function store(Request $request){
         $validated = $request->validate([
            "vendor_name" => 'required',
            "vendor_email" => 'required',
            "vendor_phone" => 'required',
            "business_name" => 'required',
            "vendor_address" => 'required', 
         ]);  
         try{
           $vendor_id = Vendor::create([
               "name" => $request->vendor_name,
               "profile_image" => '',
               "business_name" => $request->business_name,
               "email" => $request->vendor_email,
               "phone" => $request->vendor_phone,
               "address" => $request->vendor_address
            ])->id; 
            if($request->hasFile('vendor_image')){
               $profile_image = $request->vendor_image;
               $file_name = time().'.'.$profile_image->getClientOriginalExtension();
               $profile_image->move(public_path('assets/backend/upload/vendor'), $file_name);
               Vendor::where('id', $vendor_id)->update([
                  "profile_image" => 'public/assets/backend/upload/vendor/'.$file_name
               ]);
            }
         }catch(\Exception $e){ 
           return 'Something went wrong';
         } 
         return redirect()->route('backend.vendor.index')->with('vendor_created', "Vendor has been created successfully!");
     }


     public function update(Request $request, $id){
      $validated = $request->validate([
         "vendor_name" => 'required',
         "vendor_email" => 'required',
         "vendor_phone" => 'required',
         "business_name" => 'required',
         "vendor_address" => 'required', 
      ]);  
      try{
        $vendor_id = Vendor::where('id', $id)->update([
            "name" => $request->vendor_name, 
            "business_name" => $request->business_name,
            "email" => $request->vendor_email,
            "phone" => $request->vendor_phone,
            "address" => $request->vendor_address
        ]);
         if($request->hasFile('vendor_image')){
            $profile_image = $request->vendor_image;
            $file_name = time().'.'.$profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('assets/backend/upload/vendor'), $file_name);
            Vendor::where('id', $id)->update([
               "profile_image" => 'public/assets/backend/upload/vendor/'.$file_name
            ]);
         }
      }catch(\Exception $e){ 
        return 'Something went wrong';
      } 
      return redirect()->route('backend.vendor.index')->with('vendor_updated', "Vendor has been updated successfully!");
  }

   public function destroy(Request $request){
      $id = $request->id; 
      // $exist_in_stock = Stock::where('vendor_id', $id)->get();

         // if($exist_in_stock){
         try{
            Vendor::findOrFail($id)->delete();
         }catch(\Exception $e){
            return response()->json([
               'status' => 400,
               'message' => 'something_wrong'
         ]);
         } 
         return response()->json([
             'status' => 200,
             'message' => 'success'
         ]); 
      // }else{
      //    return response()->json([
      //       'status' => 400,
      //       'message' => 'already_in_use'
      //   ]); 
      // }
  }
    
}
