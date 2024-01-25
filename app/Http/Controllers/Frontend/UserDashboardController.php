<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function userDashboardPageView(){
        return view('frontend.account.user_dashboard');
    }
}
