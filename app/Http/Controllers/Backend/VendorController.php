<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Stock;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){

      $vendor_list = Vendor::select('*');
      if(isset($_GET['sort_by']) && $_GET['sort_by'] != ''){

         $vendor_list = $vendor_list->orderBy('name', $_GET['sort_by']);
     }else{
      $vendor_list = $vendor_list->orderBy('id', 'desc');
     }
     $vendor_list = $vendor_list->paginate(10);


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
         // $validated = $request->validate([
         //    "vendor_name" => 'required',
         //    "vendor_email" => 'required',
         //    "vendor_phone" => 'required',
         //    "business_name" => 'required',
         //    "vendor_address" => 'required', 
         // ]);  
         try{
           $vendor_id = Vendor::create([
               "name" => $request->vendor_name,
               "profile_image" => '',
               "business_name" => $request->business_name,
               "email" => $request->vendor_email,
               "phone" => $request->vendor_phone,
               "address" => $request->vendor_address,
               "gst" => $request->vendor_gst
            ])->id;

            // if($request->hasFile('vendor_image')){
            //    $profile_image = $request->vendor_image;
            //    $file_name = time().'.'.$profile_image->getClientOriginalExtension();
            //    $profile_image->move(public_path('assets/backend/upload/vendor'), $file_name);
            //    Vendor::where('id', $vendor_id)->update([
            //       "profile_image" => 'public/assets/backend/upload/vendor/'.$file_name
            //    ]);
            // }

         }catch(\Exception $e){ 
           return 'Something went wrong';
         } 
         return redirect()->route('backend.vendor.index')->with('vendor_created', "Vendor has been created successfully!");
     }


     public function update(Request $request, $id){
      $validated = $request->validate([
         "vendor_name" => 'required', 
      ]);  
      try{
        $vendor_id = Vendor::where('id', $id)->update([
            "name" => $request->vendor_name, 
            "business_name" => $request->business_name,
            "email" => $request->vendor_email,
            "phone" => $request->vendor_phone,
            "address" => $request->vendor_address,
            "gst" => $request->vendor_gst
        ]);
         // if($request->hasFile('vendor_image')){
         //    $profile_image = $request->vendor_image;
         //    $file_name = time().'.'.$profile_image->getClientOriginalExtension();
         //    $profile_image->move(public_path('assets/backend/upload/vendor'), $file_name);
         //    Vendor::where('id', $id)->update([
         //       "profile_image" => 'public/assets/backend/upload/vendor/'.$file_name
         //    ]);
         // }
      }catch(\Exception $e){ 
        return 'Something went wrong';
      } 
      return redirect()->route('backend.vendor.index')->with('vendor_updated', "Vendor has been updated successfully!");
  }

   public function destroy(Request $request){
      $id = $request->id; 
     
      $exist_in_stock = Stock::where('vendor_id', $id)->get();

         if(count($exist_in_stock) > 0){ 
            return response()->json([
               'status' => 400,
               'message' => 'already_in_use'
           ]);  
      }else{
         Vendor::findOrFail($id)->delete();
         return response()->json([
            'status' => 200,
            'message' => 'deleted'
        ]); 
      }
  }


  public function search(Request $request){
   $search_val = $request->search_val;
   if($search_val != ''){
       $search_result = Vendor::where('name', 'LIKE', '%'.$search_val.'%')
       ->orWhere('email', 'LIKE', '%'.$search_val.'%')->get();
   }else{
       $search_result = Vendor::orderBy('id', 'desc')->paginate(10);
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
            $html .= '<tr id="vendor_list_'.$search_data->id.'">';
            $html .= '<td style="display: table-cell;">'.($index+1).'</td>';
            $html .= '<td style="display: table-cell;"> ';
            $html .= '<div class="vendor_img">';
            $html .= '<img src="'.url($search_data->profile_image != "" ? $search_data->profile_image:"public\assets\backend\images\profile\default-user.png").'">';
            $html .= '</div>   ';
            $html .= '</td>';
            $html .= '<td style="display: table-cell;">'.$search_data->name.'</td>';
            $html .= '<td style="display: table-cell;">'.$search_data->phone.'</td>';
            $html .= '<td>'.$search_data->email.'</td>';
            $html .= '<td>'.$search_data->business_name.'</td> ';
            $html .= '<td class="footable-last-visible ">';
            $html .= '<div class="d-flex "> ';
            $html .= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"';
            $html .= 'href="'.route('backend.vendor.edit', [$search_data->id]).'" title="Edit">';
            $html .= '<i class="fa-regular fa-pen-to-square text-white"></i>';
            $html .= '</a> ';
            $html .= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico"';
            $html .= 'id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
            $html .= '</div>';
            $html .= '</td>';
            $html .= '</tr>';
       }
   }
   return $html;
}
    
}
