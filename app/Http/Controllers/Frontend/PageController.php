<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutPageView(){
        return view('frontend.pages.about_us');
    }

    public function privacyPolicyPageView(){
        return view('frontend.pages.privacy_policy');
    }

    public function termsAndConditionPageView(){
        return view('frontend.pages.terms_and_condition');
    }

    public function contactUsPageView(){
        return view('frontend.pages.contact_us');
    }
}
