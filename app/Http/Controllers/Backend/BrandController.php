<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Brand;


class BrandController extends Controller{
    public function index(){
        $brand_list = Brand::orderBy('id', 'desc')->paginate(10);
        return view('backend.brand.index', compact('brand_list')); 
    }

    public function store(Request $request){
        $name = $request->name; 
        $fileStorePath = 'assets/backend/upload/brand_logo';  
        $fileFromRequest = $request->file('logo');   // geting file form request
        $originalFileName = $fileFromRequest->getClientOriginalName();  // gettign original file name 
        $fileNameNew = $name.'_brand_logo_'.time().'.'.$fileFromRequest->getClientOriginalExtension();  // creating new file name 
        $fileFromRequest->move(public_path($fileStorePath), $fileNameNew);   // uploadin file in project folder
       
        Brand::create([
            'name' => $name,
            'logo' => 'public/'.$fileStorePath.'/'.$fileNameNew,
            'status' => 1,
        ]);
        return redirect()->back()->with('success', "Brand has been added successfully"); 
    }


    public function edit($id){
        $brand_detail = Brand::where('id', $id)->first();
        return view('backend.brand.edit', compact('brand_detail'));
    }

    public function update(Request $request){
        $id = $request->id; 
        $name = $request->name; 
            if($request->has('logo')){
                $fileStorePath = 'assets/backend/upload/brand_logo';  
                $fileFromRequest = $request->file('logo');   // geting file form request
                $originalFileName = $fileFromRequest->getClientOriginalName();  // gettign original file name 
                $fileNameNew = $name.'_brand_logo_'.time().'.'.$fileFromRequest->getClientOriginalExtension();  // creating new file name 
                $fileFromRequest->move(public_path($fileStorePath), $fileNameNew);   // uploadin file in project folder
                Brand::where('id', $id)->update([
                    'logo' => 'public/'.$fileStorePath.'/'.$fileNameNew
                ]);
            } 
        Brand::where('id', $id)->update([
            'name' => $name
        ]);
        return redirect()->route('backend.brand.index')->with('update', "Brand has been update successfully"); 
    }

    public function destroy(Request $request){
        $id  = $request->id; 
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('destroy', "Brand has been deleted successfully"); 
    }

    public function search(Request $request){
        $search_val = $request->search_val;
        $search_brand_list = Brand::where('name', 'LIKE', '%'.$search_val.'%')->get();
        $html = '';
        $count = 1;
        foreach ($search_brand_list as $brand) {
            $html .= '<tr>';
            $html .= '<td class="" style="display: table-cell;">' . $count++ . '</td>';
            $html .= '<td style="display: table-cell;">' . $brand->name . '</td>';
            $html .= '<td style="display: table-cell; text-align: center;"><img class="brand-page" src="' . url($brand->logo) . '" width="30%"></td>';
            $html .= '<td class="pull-right d-flex">';
            $html .= '<a href="' . route('backend.brand.edit', [$brand->id]) . '"><i class="fa-regular fa-pen-to-square text-white edit_icon"></i></a>';
            $html .= '<button value="' . $brand->id . '" class="btn btn-sm delete_ico delete_button"><i class="fa fa-trash-o"></i></button>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        return $html;
    }
}