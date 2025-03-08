<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Mail;
use App\Rules\Recaptcha;

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
    public function submitContactPage(Request $request){
        $validate = $request->validate([
            'g-recaptcha-response' => ['required', new Recaptcha()],
            "name" => ['required', 'string', "max:50"],
            "email" => ['required', 'email'],
            "message" => ['required']
        ]);
        try{
            $contact_mail_data = [
                "name" => $request->name,
                "email" => $request->email,
                "message" => $request->message
            ];
             Mail::to($request->email)->send(new ContactMail($contact_mail_data));
             session()->flash('submitted', 'Your enquiry has been submitted.');
             return view('frontend.pages.contact_us');
        }catch(\Exception $e){
            return "Something Went Wrong";
        }
    }
    public function viewProductPageView(){
        return view('frontend.product.index');
    }
    public function viewSingleProductView(){
        return view('frontend.product.single_product');
    }
    public function returnView(){
        return view('frontend.pages.return');
    }
}
