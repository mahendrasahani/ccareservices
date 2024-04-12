<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homePageView(){
        $orderCounts = OrderProduct::select('product_id', DB::raw('COUNT(*) as count'))
        ->groupBy('product_id')->orderBy('count', 'desc')->get();
        $product_ids = [];
        foreach($orderCounts as $order){
            $product_ids[] =$order->product_id; 
        } 
        $product_list = Product::whereIn('id', $product_ids)->get();
        return view('frontend.home', compact('product_list'));
    } 

    

    public function testCommand(){
        $orders = Order::with('getOrderProduct')->get();
       return view('frontend.pages.alert_test', compact('orders'));
    }
 
}
