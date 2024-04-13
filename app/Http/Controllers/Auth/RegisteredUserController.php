<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'max:10', 'unique:'.User::class],
        ]); 
        $otp = random_int(1000, 9999); 
        $otp_mail_data = [
            "user_name" => $request->name,
            "otp" => $otp
        ];

    try {
    Mail::to($request->email)->send(new OtpMail($otp_mail_data)); 
    $response = Http::get('https://api.msg91.com/api/sendhttp.php?authkey=372411AIYHh0nX61f29867P1&sender=COOLCS&mobiles=91'.$request->phone.'&route=transactional &message=Your OTP Verification Code from COOLCARE SERVICES is '.$otp.'. Do not share it with anyone.&DLT_TE_ID=1307164337662843810&response=json&pluginsource=70');
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => 2,
        'otp_verify_status' => 0,
        'phone' => $request->phone,
        'otp' => $otp, 
    ]);
    return redirect()->route('otp.verify', ['user' => $user->id]);
    }catch (\Exception $e){
        return $e->getMessage();
    }

        // return view('auth.enter-otp', compact('user'));
        // event(new Registered($user)); 
        // Auth::login($user); 
        // return redirect(RouteServiceProvider::HOME);
    }

    public function verifyOtp($user){
        $user = User::findOrFail($user);
        return view('auth.enter-otp', compact('user'));
    }
    public function verifyOtpSubmit(Request $request, $user_id){
        $otp = $request->otp;
        $user = User::where('id', $user_id)->first();

        if($otp == $user->otp){
            User::where('id', $user_id)->update([
                "otp_verify_status" => 1,
                "otp" => null
            ]);
        event(new Registered($user)); 
        Auth::login($user); 
        return redirect(RouteServiceProvider::HOME);
        }else{
            return redirect()->route('otp.verify', [$user->id])->with('incorrect_otp', "Otp not match");
        }
 
    }


    public function reVerifyOtp($user){
        $user = User::findOrFail($user);
        return view('auth.re_verify_otp', compact('user'));
    }
    public function reVerifyOtpSubmit(Request $request, $user_id){ 
        try{
        $otp = $request->otp;
        $user = User::where('id', $user_id)->first();

        if($otp == $user->otp){
            User::where('id', $user_id)->update([
                "otp_verify_status" => 1,
                "otp" => null
            ]); 
        return redirect(RouteServiceProvider::HOME);
        }else{
            return redirect()->route('otp.re_verify', [$user->id])->with('incorrect_otp', "Otp not match");
        }
    }catch(\Exception $e){
        return $e->getMessage();
    }
 
    }

    public function editPhoneNumber(Request $request, $user){
        $otp = random_int(1000, 9999); 
            User::where('id', $user)->update([
                "phone" => $request->phone,
                "otp" => $otp 
            ]);
            $response = Http::get('https://api.msg91.com/api/sendhttp.php?authkey=372411AIYHh0nX61f29867P1&sender=COOLCS&mobiles=91'.$request->phone.'&route=transactional &message=Your OTP Verification Code from COOLCARE SERVICES is '.$otp.'. Do not share it with anyone.&DLT_TE_ID=1307164337662843810&response=json&pluginsource=70');
            return redirect()->back();
    }

    public function resendOtp(Request $request){
        $user_id = $request->user_id;
        $phone = $request->phone; 
        $otp = random_int(1000, 9999); 

        User::where('id', $user_id)->update([
            "phone" => $request->phone,
            "otp" => $otp,
            $response = Http::get('https://api.msg91.com/api/sendhttp.php?authkey=372411AIYHh0nX61f29867P1&sender=COOLCS&mobiles=91'.$request->phone.'&route=transactional &message=Your OTP Verification Code from COOLCARE SERVICES is '.$otp.'. Do not share it with anyone.&DLT_TE_ID=1307164337662843810&response=json&pluginsource=70');
        ]);
       return response()->json([
        "status" => 200,
        "message" => "otp_resend"
       ]);
    }
   
}
