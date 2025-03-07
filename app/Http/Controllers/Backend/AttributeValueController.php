<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\Attribute;
use Illuminate\Http\Request;
 

class AttributeValueController extends Controller{
    public function index($id){
        $attribute_value_list = AttributeValue::with('Attribute')->where('attribute_id', $id)->orderBy('sort_order', 'asc')->paginate(10);
        $attribute_detail = Attribute::where('id', $id)->first(); 

        return view('backend.attribute_value.index', compact('attribute_value_list', 'attribute_detail'));
    }

    public function store(Request $request){
        $attribute_id = $request->attribute_id;
        $attribute_value = $request->attribute_value;
        $sort_order = $request->sort_order;

        AttributeValue::create([
            'attribute_id' => $attribute_id,
            'name' => $attribute_value,
            'sort_order' => $sort_order,
            'status' => 1
        ]);
        return redirect()->back()->with('success', "Attribute Value has been added successfully");    
    }

    public function edit($id){
        $attribute_value_detail = AttributeValue::where('id', $id)->first();
        // return $attribute_value_detail;
        return view('backend.attribute_value.edit', compact('attribute_value_detail'));
    }

    public function update(Request $request, $id, $attribute_id){ 
        AttributeValue::where('id', $id)->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order
        ]);
        return redirect()->route('backend.attribute_value.index', [$attribute_id])->with('update', "Attribute value has been update successfully"); 
    }

}
