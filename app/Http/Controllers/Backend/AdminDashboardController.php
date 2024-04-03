<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminDashboardPageView(){
        $total_customers = User::where('user_type', 2)->count();
        $total_order = Order::where('status', 1)->count();
        $total_sales = Order::where('status', 1)->where('order_status', 'delivered')->sum('total');
        $total_product = Product::count(); 
        $latest_order = Order::orderBy('id', 'desc')->paginate(5);
        return view('backend.dashboard.index', compact('total_customers', 'total_order', 'total_sales', 'total_product',
    'latest_order'));
    }
}
