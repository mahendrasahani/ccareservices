<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\MainCategory;
use App\Models\Backend\Product;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;
use Str;    

class MainCategoryController extends Controller
{
    public function index(){
        $main_cat_list = MainCategory::orderBy('id', 'desc')->paginate(10);
        return view('backend.main_category.index', compact('main_cat_list'));
    }

    public function create(){ 
        $attribute_list = Attribute::where('status', 1)->get();
        return view('backend.main_category.create', compact('attribute_list'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'slug' => 'required|unique:main_categories'
        ]);

        $name = $request->name;
        $order_number = $request->order_number;
        $meta_title = $request->meta_title;
        $slug = $request->slug;
        $meta_description = $request->meta_description; 
        $filtering_attributes = collect($request->filtering_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 
     
        $newMainCategory = MainCategory::create([
            'name' =>$name,
            'ordering_number' => $order_number,
            'slug' => Str::slug($slug),
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
           
            'filtering_attribute' => $filtering_attributes,
            'status' => 1
        ]);
        $newMainCategoryId = $newMainCategory->id;

        if($request->has('thumbnail_img')){
        $thumbnailImgPath = 'assets/backend/upload/main_category_thumbnail';
        $thumbnailImgFromRequest = $request->file('thumbnail_img');
        $originalThumbnailName = $request->file('thumbnail_img')->getClientOriginalName();
        $thumbnailNewName = $name.'_thumbnail_'.time().'.'.$thumbnailImgFromRequest->getClientOriginalExtension();
        $thumbnailImgFromRequest->move(public_path($thumbnailImgPath), $thumbnailNewName);
        MainCategory::where('id', $newMainCategoryId)->update([ 
            'thumbnail' => 'public/'.$thumbnailImgPath.'/'.$thumbnailNewName
        ]);
        }

        if($request->has('meta_img')){ 
        $metaImgPath = 'assets/backend/upload/main_category_meta_img';
        $metaImgFromRequest = $request->file('meta_img');
        $originalMetaImgName = $request->file('meta_img')->getClientOriginalName();
        $metaImgNewName = $name.'_meta_img_'.time().'.'.$metaImgFromRequest->getClientOriginalExtension();
        $metaImgFromRequest->move(public_path($metaImgPath), $metaImgNewName);
        MainCategory::where('id', $newMainCategoryId)->update([ 
            'meta_image' => 'public/'.$metaImgPath.'/'.$metaImgNewName
        ]);
        }
        
        return redirect()->route('backend.main_category.index')->with('success', "Main Category has been added successfully");   
    }

    public function edit($id){ 
        $attribute_list = Attribute::where('status', 1)->get();
        $main_cat_detail = MainCategory::where('id', $id)->first(); 
        return view('backend.main_category.edit', compact('main_cat_detail', 'attribute_list'));
    }

    public function update(Request $request, $id){
        $name = $request->name;
        $order_number = $request->ordering_number; 
        $meta_title = $request->meta_title;
        $meta_description = $request->meta_description; 
        $slug = $request->slug;
        $filtering_attributes = collect($request->filtering_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 

        if($request->has('thumbnail_image')){
            $thumbnailImgPath = 'assets/backend/upload/main_category_thumbnail';
            $thumbnailImgFromRequest = $request->file('thumbnail_image');
            $originalThumbnailName = $request->file('thumbnail_image')->getClientOriginalName();
            $thumbnailNewName = $name.'_thumbnail_'.time().'.'.$thumbnailImgFromRequest->getClientOriginalExtension();
            $thumbnailImgFromRequest->move(public_path($thumbnailImgPath), $thumbnailNewName);
            MainCategory::where('id', $id)->update([
                'thumbnail' => 'public/'.$thumbnailImgPath.'/'.$thumbnailNewName
            ]);
        }

            if($request->has('meta_image')){
                $metaImgPath = 'assets/backend/upload/main_category_meta_img';
                $metaImgFromRequest = $request->file('meta_image');
                $originalMetaImgName = $request->file('meta_image')->getClientOriginalName();
                $metaImgNewName = $name.'_meta_img_'.time().'.'.$metaImgFromRequest->getClientOriginalExtension();
                $metaImgFromRequest->move(public_path($metaImgPath), $metaImgNewName);
                MainCategory::where('id', $id)->update([
                    'meta_image' => 'public/'.$metaImgPath.'/'.$metaImgNewName
                ]); 
            }  
            MainCategory::where('id', $id)->update([
                'name' =>$name,
                'ordering_number' => $order_number, 
                'meta_title' => $meta_title,
                'meta_description' => $meta_description, 
                'filtering_attribute' => $filtering_attributes, 
               'slug' => $slug
            ]);
        return redirect()->route('backend.main_category.index')->with('update', "Main Category has been update successfully");   
    }

    public function changeStatus(Request $request){
        $main_cat_id = $request->main_category_id;
        $status = $request->status;
        MainCategory::where('id', $main_cat_id)->update([
            'status' => $status
        ]);
        return response()->json([
            'status' => 200,
            'message' => "success"
        ]);
    }

    public function destroy(Request $request){
        $id = intval($request->id);
        $main_cat = MainCategory::find($id); 
        $exist_in_product = Product::whereJsonContains('main_category', $id)->get();
        $exist_in_sub_cat = SubCategory::where('main_category_id', $id)->get();
 
        if(count($exist_in_product) > 0){
            return response()->json([
                'status' => 400,
                'message' => 'exist_in_product'
            ]);
        }elseif(count($exist_in_sub_cat) > 0){
            return response()->json([
                'status' => 400,
                'message' => 'exist_in_s_cat'
            ]);
        }
        else{
            $main_cat->delete();  
            return response()->json([
                'status' => 200,
                'message' => 'deleted'
            ]);
        }  
       
      
    }

    public function search(Request $request){
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = MainCategory::where('name', 'LIKE', '%'.$search_val.'%')->get();
        }else{
            $search_result = MainCategory::orderBy('id', 'desc')->paginate(10);
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
                $html.= '<tr>';
                $html.= '<tr id="cat_list_'.$search_data->id.'">';
                $html.= '<td style="display: table-cell;">'.$count++.'</td>';
                $html.= '<td>'.$search_data->name.'</td>';
                $html.= '<td>'.$search_data->ordering_number.'</td>';
                $html.= '<td style="width:15%"><img src="'.($search_data->thumbnail != '' ? url($search_data->thumbnail) : url('public/assets/both/placeholder/main_category.jpg') ).'" width="100%"></td>';
                $html.= '<td>';
                $html.= '<label class="switch">';
                $html.= '<input type="checkbox"'.($search_data->status == 1 ? 'checked':'').' id="status" name="status" value="'.$search_data->status.'" data-id="'.$search_data->id.'">';
                $html.= '<span class="slider"></span>';
                $html.= '</label>';
                $html.= '</td>';
                $html.= '<td class="footable-last-visible">';
                $html.= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="'.route('backend.main_category.edit', [$search_data->id]).'" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>';
                $html.= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
                $html.= '</td>';
                $html.= '</tr>';
            }
        }
        return $html;
    }
}


