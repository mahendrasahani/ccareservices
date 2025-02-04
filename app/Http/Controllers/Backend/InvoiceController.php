<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($id){ 
        $order = Order::with(['getOrderProduct:order_id,product_name,quantity,price,month,total_price,product_id,option_id,option_value_id', 
        'getOrderProduct.getProduct:id,product_images,tax_name,tax_rate'])->where('id', $id)->first(); 
        
        // return $order;
        return view('backend.invoice.index', compact('order'));
    }


}
