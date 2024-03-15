<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function userDashboardPageView(){
        $total_products_in_cart = Cart::where('user_id', Auth::user()->id)->count();
        $total_products_in_order_list = Order::where('user_id', Auth::user()->id)->count();
        $recent_purchase_history = OrderProduct::with('getProduct:id,product_name,product_images')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
       $default_shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
        return view('frontend.account.user_dashboard', compact('total_products_in_cart', 'total_products_in_order_list',
        'recent_purchase_history', 'default_shipping_address'));
    }

    public function manageProfilePageView(){
        return view('frontend.account.manage_profile');
    }
    public function discountPageView(){
        return view('frontend.account.discount');
    }
    public function purchaseHistoryPageView(){
        return view('frontend.account.purchase_history');
    }
    public function viewProductDetailPageView(){
        return view('frontend.account.view_product_detail');
    }
   
}
