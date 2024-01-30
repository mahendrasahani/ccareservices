<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(){
        $attribute_list = Attribute::with('attributeValues')->orderBy('id', 'desc')->paginate(10);
        return view('backend.attribute.index', compact('attribute_list'));
    }

    public function store(Request $request){
        $name = $request->name;
        Attribute::create([
            'name' => $name,
            'status' => 1,
        ]);
        return redirect()->back()->with('success', "Attribute has been added successfully"); 
    }

    public function edit($id){
        $attribute_detail = Attribute::where('id', $id)->first();
        return view('backend.attribute.edit', compact('attribute_detail'));
    }

    public function update(Request $request, $id){ 
        Attribute::where('id', $id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('backend.attribute.index')->with('update', "Attribute has been update successfully"); 
    }
}
