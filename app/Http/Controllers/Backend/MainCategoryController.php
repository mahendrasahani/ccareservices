<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\MainCategory;
use Illuminate\Http\Request;

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
        $name = $request->name;
        $order_number = $request->order_number;
        $meta_title = $request->meta_title;
        $meta_description = $request->meta_description; 
        $filtering_attributes = collect($request->filtering_attributes)->map(function ($value) {
            return intval(trim($value, '"'));
        })->all(); 
     

        $thumbnailImgPath = 'assets/backend/upload/main_category_thumbnail';
        $thumbnailImgFromRequest = $request->file('thumbnail_img');
        $originalThumbnailName = $request->file('thumbnail_img')->getClientOriginalName();
        $thumbnailNewName = $name.'_thumbnail_'.time().'.'.$thumbnailImgFromRequest->getClientOriginalExtension();
        $thumbnailImgFromRequest->move(public_path($thumbnailImgPath), $thumbnailNewName);

        $metaImgPath = 'assets/backend/upload/main_category_meta_img';
        $metaImgFromRequest = $request->file('meta_img');
        $originalMetaImgName = $request->file('meta_img')->getClientOriginalName();
        $metaImgNewName = $name.'_meta_img_'.time().'.'.$metaImgFromRequest->getClientOriginalExtension();
        $metaImgFromRequest->move(public_path($metaImgPath), $metaImgNewName);

        MainCategory::create([
            'name' =>$name,
            'ordering_number' => $order_number,
            'thumbnail' => 'public/'.$thumbnailImgPath.'/'.$thumbnailNewName,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_image' => 'public/'.$metaImgPath.'/'.$metaImgNewName,
            'filtering_attribute' => $filtering_attributes,
            'status' => 1
        ]);
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

}
