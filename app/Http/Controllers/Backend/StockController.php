<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\Product;
use App\Models\Backend\Stock;
use App\Models\Backend\Tax;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $stock_list = Stock::with(['getProduct:id,product_name', 'getAttr:id,name', 'getAttrValue:id,name'])
        ->whereHas('getProduct', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->where('status', 1)->orderBy('id', 'desc')->paginate(10);  
        return view('backend.stock.index', compact('stock_list'));
    }

    public function create(Request $request){
        $product_list = Product::get();
        $variant_type = Attribute::where('status', 1)->get();
        $variant_value = AttributeValue::where('status', 1)->get();
        $vendor_list = Vendor::get();
        $taxes = Tax::where('status', 1)->get();
        return view('backend.stock.create', compact('product_list', 'variant_type', 'variant_value', 'vendor_list', 'taxes'));
    }

    public function store(Request $request){
        // return $request->all(); 
        $validated = $request->validate([
            "product" => 'required',
            "select_variant_type" => 'required',
            "select_option_value" => 'required',
            "quantity" => 'required',
            "price_1" => 'required',
            "price_2" => 'required',
            "price_3" => 'required',
            "price_4" => 'required',
            "price_5" => 'required',
            "price_6" => 'required',
            "price_7" => 'required',
            "price_8" => 'required',
            "price_9" => 'required',
            "price_10" => 'required',
            "price_11" => 'required',
            "price_12" => 'required',
            "vendor_name" => 'required',
            "date_of_purchase" => 'required',
            "purchase_amount" => 'required',
            "invoice_number" => 'required', 
        ]);

        try{
            $stock_status= '';
            if($request->quantity > 0){
                $stock_status = 1;
            }else{
                $stock_status = 0;
            }
            Stock::create([
                "product_id" => $request->product,
                "quantity" => $request->quantity,
                "attribute_id" => $request->select_variant_type,
                "attribute_value_id" => $request->select_option_value,
                "price_1" => $request->price_1,
                "price_2" => $request->price_2,
                "price_3" => $request->price_3,
                "price_4" => $request->price_4,
                "price_5" => $request->price_5,
                "price_6" => $request->price_6,
                "price_7" => $request->price_7,
                "price_8" => $request->price_8,
                "price_9" => $request->price_9,
                "price_10" => $request->price_10,
                "price_11" => $request->price_11,
                "price_12" => $request->price_12,
                "vendor_id" => $request->vendor_name,
                "date_of_purchase" => $request->date_of_purchase,
                "purchase_amount" => $request->purchase_amount,
                "invoice_no" => $request->invoice_number,
                "stock_staus" => $stock_status,
                "status" => 1,
            ]);
               

        }catch(\Exception $e){
            return "Something went wrong";
        } 
        return redirect()->route('backend.stock.index')->with('stock_added', 'Stock has been added successfully !');
    }

    public function edit($id)
    {
        $stock = Stock::where('id', $id)->first();
        $product_list = Product::get();
        $variant_type = Attribute::where('status', 1)->get(); 
        $variant_value = AttributeValue::where('attribute_id', $stock->attribute_id)->where('status', 1)->get(); 
        $vendor_list = Vendor::get();
        return view('backend.stock.edit', compact('stock', 'product_list', 'variant_type', 'variant_value', 'vendor_list'));
    }

    public function getVariantValueList(Request $request){
        $variant_id = $request->variant_id;
        try{
            $variant_value_list = AttributeValue::where('attribute_id', $variant_id)->where('status', 1)->get();
        }catch(\Exception $e){
            return response()->json([
                "status" => 400,
                "message" => "something_went_wrong"
            ]);
        } 
        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $variant_value_list
        ]); 
    }

    public function update(Request $request, $id){ 
        try{
            $stock_status= '';
            if($request->quantity > 0){
                $stock_status = 1;
            }else{
                $stock_status = 0;
            }
            Stock::where('id', $id)->update([
                "product_id" => $request->product,
                "quantity" => $request->quantity,
                "attribute_id" => $request->select_variant_type,
                "attribute_value_id" => $request->select_option_value,
                "price_1" => $request->price_1,
                "price_2" => $request->price_2,
                "price_3" => $request->price_3,
                "price_4" => $request->price_4,
                "price_5" => $request->price_5,
                "price_6" => $request->price_6,
                "price_7" => $request->price_7,
                "price_8" => $request->price_8,
                "price_9" => $request->price_9,
                "price_10" => $request->price_10,
                "price_11" => $request->price_11,
                "price_12" => $request->price_12,
                "vendor_id" => $request->vendor_name,
                "date_of_purchase" => $request->date_of_purchase,
                "purchase_amount" => $request->purchase_amount,
                "invoice_no" => $request->invoice_number,
                "stock_staus" => $stock_status,
                "status" => 1,
            ]);
        }catch(\Exception $e){
            return "Something went wrong";
        } 
        return redirect()->route('backend.stock.index')->with('stock_updated', 'Stock has been update successfully !');

    }


    public function destroy(Request $request){
        $id = $request->id;
        $stock = Stock::find($id);
        $delete_result = $stock->delete();
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


// ------------------------------------------------------------------------------------------
    public function search(Request $request){
        $search_val = $request->search_val;
        if($search_val != ''){
            $search_result = Stock::whereHas('getProduct', function ($query) use ($search_val) {
                $query->where('product_name', 'like', '%'.$search_val.'%');
            })->get();
        }else{
            $search_result = Stock::orderBy('id', 'desc')->paginate(10);
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
                $html .= '<tr id="row_id_'.$search_data->id.'">';
                $html .= '<td style="display: table-cell;">'.($index+1).'</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->getProduct->product_name.'</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->getAttr->name.'</td>';
                $html .= '<td style="display: table-cell;">'.$search_data->getAttrValue->name.'</td>';
                $html .= '<td>'.$search_data->quantity.'</td> ';
                $html .= '<td class="text-left footable-last-visible ">';
                $html .= '<div class="d-flex justify-content-center ">';
                $html .= '<a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="'.route('backend.stock.edit', [$search_data->id]).'" title="Edit">';
                $html .= '<i class="fa-regular fa-pen-to-square text-white"></i>';
                $html .= '</a>';
                $html .= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '</tr>';
            }
        }
        return $html;
     } 
// ------------------------------------------------------------------------------------------




}
