<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePageView(){
        return view('frontend.home');
    } 

    public function otpMail(){
        return view('emails.otp_mail');
    }
}
