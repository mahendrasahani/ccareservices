<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\RecentActivity;
use App\Models\Frontend\Cart;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Session;
use App\Rules\Recaptcha;

class AuthenticatedSessionController extends Controller
{ 
    public function create(): View{
        session()->put('previous_url', url()->previous());
        return view('auth.login');
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) {
        $previousUrl = session()->get('previous_url');
        $request->authenticate();
        $request->session()->regenerate();
        $user_type = Auth::user()->user_type;
        $token = Auth::user()->createToken('Personal Access Token')->plainTextToken;
        $ipAddress = $request->ip();
        if ($ipAddress === '::1') { 
            $ipAddress = '122.162.146.135'; 
        }
        $location_data = Http::get('http://ip-api.com/json/122.162.146.135');
        $cart = session()->get('cart'); 
        if($cart != '') {
            foreach($cart as $index => $item) {
                $product = Cart::where('product_id', $cart[$index]['product_id'])->where('user_id', Auth::user()->id)->first();
                $attribute = AttributeValue::where('id', $cart[$index]['option_value_id'])->first()->attribute_id;
                if($product){
                    Cart::where('user_id', Auth::user()->id)->where('product_id', $cart[$index]['product_id'])->update([
                        'user_id' => Auth::user()->id,
                        'product_id' => $cart[$index]['product_id'],
                        'quantity' => $cart[$index]['quantity'],  
                        'delivery_date' => $cart[$index]['delivery_date'],
                        'option_id' => $attribute,
                        'option_value_id' => $cart[$index]['option_value_id'],
                        'month' => $cart[$index]['month'],
                        'price' => $cart[$index]['price'],
                        'stock_id' => $cart[$index]['stock_id'],
                        'status' => 1
                    ]); 
                }else{
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $cart[$index]['product_id'],
                    'quantity' => $cart[$index]['quantity'],  
                    'delivery_date' => $cart[$index]['delivery_date'],
                    'option_id' => $attribute,
                    'option_value_id' => $cart[$index]['option_value_id'],
                    'month' => $cart[$index]['month'],
                    'price' => $cart[$index]['price'],
                    'stock_id' => $cart[$index]['stock_id'],
                    'status' => 1
                ]); 
            }
            }
        }  
        Session::forget('cart');
       
        if($user_type == 1 || $user_type == 0){
            return redirect('/admin/dashboard?'.$token);
        }else{ 
            // return $location_data;
        //   here store in ip in recent activity tabel
        RecentActivity::create([
            "user_id" => Auth::user()->id,
            "user_name" => Auth::user()->name,
            "user_email" => Auth::user()->email,
            "user_phone" => Auth::user()->phone, 
            "country" => $location_data['country'],
            "country_code" => $location_data['countryCode'],
            "region" => $location_data['region'],
            "city" => $location_data['city'],
            "zip" => $location_data['zip'],
            "timezone" => $location_data['timezone'],
            "long" => $location_data['lon'],
            "lati" =>  $location_data['lat'],
            "ip_address" => $ipAddress,
            "isp" => $location_data['isp'],
            "org" => $location_data['org'],
            "as" => $location_data['as'],
           ]);
            return redirect($previousUrl);
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse{
        Auth::guard('web')->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/');
    }

    public function checkAccount(Request $request){
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user == '' || $user == null){
            return response()->json([
                "status" => 200,
                "message" => "user_not_found"
            ], 200);
        }else{
            return response()->json([
                "status" => 200,
                "message" => "user_found"
            ], 200);
        }
    }

    public function sendLoginOTP(Request $request){ 
        $validate = $request->validate([
            // 'g-recaptcha-response' => ['required', new Recaptcha()],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);
        try{
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if(!$user){
            return back()->withErrors(['phone' => 'You are not registered with us please sign up.']);
        }elseif($user->active_status == 0){
            return back()->withErrors(['phone' => 'Your account has been deactivated kindly contact administrator Thanks.']);
        }
        // $otp = '0909';
        $otp = random_int(1000, 9999);
        $response = Http::get('https://api.msg91.com/api/sendhttp.php?authkey=372411AIYHh0nX61f29867P1&sender=COOLCS&mobiles=91'.$request->phone.'&route=transactional &message=Your OTP Verification Code from COOLCARE SERVICES is '.$otp.'. Do not share it with anyone.&DLT_TE_ID=1307164337662843810&response=json&pluginsource=70');
         

        User::where('phone', $phone)->update([
            'otp' => $otp, 
        ]);
        return redirect()->route('otp.verify', ['user' => Crypt::encrypt($user->id)]); 
    }catch(\Exception $e) {
        abort('404');
    }

    }
}
