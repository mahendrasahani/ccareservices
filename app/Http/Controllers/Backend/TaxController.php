<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller{
    public function index(){
        $taxes = Tax::get();
        return view('backend.tax.index', compact('taxes'));
    } 
    public function create(){ 
        return view('backend.tax.create');
    } 
    public function edit($id){
        $tax = Tax::where('id', $id)->first();
        return view('backend.tax.edit', compact('tax'));
    }
    public function update(Request $request, $id){
        $validate = $request->validate([
            "tax_rate" => ['required', 'numeric']
        ]);
        $tax_rate = $request->tax_rate; 
        Tax::where('id', $id)->update([
            "tax_rate" => $tax_rate, 
        ]);
        return redirect()->route('backend.tax')->with('tax_updated', 'Tax has been successfully updated !');
    }
    public function changeStatus(Request $request){
        $tax_id = $request->tax_id;
        $status = $request->status;
        Tax::where('id', $tax_id)->update([
            'status' => $status
        ]);
        return response()->json([
            'status' => 200,
            'message' => "success"
        ]);
    }
}
