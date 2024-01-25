<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function userDashboardPageView(){
        return view('frontend.account.user_dashboard');
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
   
}
