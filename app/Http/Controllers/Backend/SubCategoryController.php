<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\MainCategory;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    public function index(){
        $sub_cat_list = SubCategory::with('mainCategory')->orderBy('id', 'desc')->paginate(10); 
        return view('backend.sub_category.index', compact('sub_cat_list'));
    }

    public function create(){ 
        $main_cat_list = MainCategory::where('status', 1)->get();
        $attribute_list = Attribute::where('status', 1)->get();
        return view('backend.sub_category.create', compact('main_cat_list', 'attribute_list'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'slug' => 'required|unique:sub_categories'
        ]);

        $name = $request->name;
        $main_category = $request->main_category; 
        $ordering_number = $request->ordering_number;
        $meta_title = $request->meta_title;
        $slug = $request->slug;
        $meta_description = $request->meta_description;  
        $filtering_attributes = collect($request->filtering_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 

        $newSubCategory = SubCategory::create([
            'name' =>$name,
            'main_category_id' => $main_category,
            'ordering_number' => $ordering_number ?? '0', 
            'slug' => Str::slug($slug),
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'filtering_attribute' => $filtering_attributes, 
            'status' => 1
        ]); 
        $newSubCategoryId = $newSubCategory->id;    

        if($request->has('thumbnail_image')){
            $thumbnailImgPath = 'assets/backend/upload/sub_category_thumbnail';
            $thumbnailImgFromRequest = $request->file('thumbnail_image');
            $originalThumbnailName = $request->file('thumbnail_image')->getClientOriginalName();
            $thumbnailNewName = $name.'_thumbnail_'.time().'.'.$thumbnailImgFromRequest->getClientOriginalExtension();
            $thumbnailImgFromRequest->move(public_path($thumbnailImgPath), $thumbnailNewName);
            SubCategory::where('id', $newSubCategoryId)->update([ 
                'thumbnail_image' => 'public/'.$thumbnailImgPath.'/'.$thumbnailNewName
            ]);
            }

            if($request->has('meta_image')){
                $metaImgPath = 'assets/backend/upload/sub_category_meta_image';
                $metaImgFromRequest = $request->file('meta_image');
                $originalMetaImgName = $request->file('meta_image')->getClientOriginalName();
                $metaImgNewName = $name.'_meta_image_'.time().'.'.$metaImgFromRequest->getClientOriginalExtension();
                $metaImgFromRequest->move(public_path($metaImgPath), $metaImgNewName);
                SubCategory::where('id', $newSubCategoryId)->update([ 
                    'meta_image' => 'public/'.$metaImgPath.'/'.$metaImgNewName
                ]);
            }
            return redirect()->route('backend.sub_category.index')->with('success', "Sub Category has been added successfully");   
    }

    public function edit(Request $request, $id){
        $main_cat_list = MainCategory::where('status', 1)->get();
        $attribute_list = Attribute::where('status', 1)->get();
        $sub_cat_detail = SubCategory::where('id', $id)->first();
        return view('backend.sub_category.edit', compact('main_cat_list', 'attribute_list', 'sub_cat_detail'));
    }


    public function update(Request $request, $id){
         

        $name = $request->name;
        $main_category = $request->main_category; 
        $ordering_number = $request->ordering_number; 
        $meta_title = $request->meta_title;
        $meta_description = $request->meta_description;  
        $filtering_attributes = collect($request->filtering_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 

        $newSubCategory = SubCategory::where('id', $id)->update([
            'name' =>$name,
            'main_category_id' => $main_category,
            'ordering_number' => $ordering_number ?? '0', 
            'meta_title' => $meta_title, 
            'meta_description' => $meta_description,
            'filtering_attribute' => $filtering_attributes, 
            'status' => 1
        ]);
        
        if($request->has('thumbnail_image')){
            $thumbnailImgPath = 'assets/backend/upload/sub_category_thumbnail';
            $thumbnailImgFromRequest = $request->file('thumbnail_image');
            $originalThumbnailName = $request->file('thumbnail_image')->getClientOriginalName();
            $thumbnailNewName = $name.'_thumbnail_'.time().'.'.$thumbnailImgFromRequest->getClientOriginalExtension();
            $thumbnailImgFromRequest->move(public_path($thumbnailImgPath), $thumbnailNewName);
            SubCategory::where('id', $id)->update([ 
                'thumbnail_image' => 'public/'.$thumbnailImgPath.'/'.$thumbnailNewName
            ]);
            }

            if($request->has('meta_image')){
                $metaImgPath = 'assets/backend/upload/sub_category_meta_image';
                $metaImgFromRequest = $request->file('meta_image');
                $originalMetaImgName = $request->file('meta_image')->getClientOriginalName();
                $metaImgNewName = $name.'_meta_image_'.time().'.'.$metaImgFromRequest->getClientOriginalExtension();
                $metaImgFromRequest->move(public_path($metaImgPath), $metaImgNewName);
                SubCategory::where('id', $id)->update([ 
                    'meta_image' => 'public/'.$metaImgPath.'/'.$metaImgNewName
                ]);
            }
            return redirect()->route('backend.sub_category.index')->with('update', "Sub Category has been update successfully");   
    }


    public function changeStatus(Request $request){
        $sub_cat_id = $request->sub_category_id;
        $status = $request->status;
        SubCategory::where('id', $sub_cat_id)->update([
            'status' => $status
        ]);
        return response()->json([
            'status' => 200,
            'message' => "success"
        ]);
    }

    public function destroy(Request $request){
        $id = $request->id;
        $sub_cat = SubCategory::find($id);
        $delete_result = $sub_cat->delete();
        if($delete_result){
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'failed'
            ]);
        }
    }

    public function search(Request $request){
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = SubCategory::where('name', 'LIKE', '%'.$search_val.'%')->get();
        }else{
            $search_result = SubCategory::orderBy('id', 'desc')->paginate(10);
        }
        $html = '';
        $count = 1;
        if($search_result->count() == 0){
            $html .= '<tr>';
            $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
            $html .= '</td>';
            $html .= '</tr>';
        }else{
            foreach($search_result as $search_data){ 
                $html .= '<tr id="cat_list_'.$search_data->id.'">';
                $html .= '<td style="display: table-cell;">'.$count++.'</td>';
                $html .= '<td>'.$search_data->name.'</td>';
                $html .= '<td>'.$search_data->mainCategory->name.'</td>';
                $html .= '<td>'.$search_data->ordering_number.'</td>';
                $html .= '<td style="width:15%"><img src="'.($search_data->thumbnail_image != '' ? url($search_data->thumbnail_image):url('public/assets/both/placeholder/sub_category.jpg')).'" width="100%"></td>';
                $html .= '<td><label class="switch">';
                $html .= '<input type="checkbox" '.($search_data->status == 1 ? 'checked':'').' id="status" name="status"  value="'.$search_data->status.'" data-id="'.$search_data->id.'">';
                $html .= '<span class="slider"></span></label>';
                $html .= '</td>';
                $html .= '<td class="footable-last-visible">';
                $html .= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="'.route('backend.sub_category.edit', [$search_data->id]).'" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>';
                $html .= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
                $html .= '</td>';
                $html .= '</tr>';  
            }
        }
        return $html;
    }


}
