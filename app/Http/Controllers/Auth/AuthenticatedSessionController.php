<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Backend\AttributeValue;
use App\Models\Frontend\Cart;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        $request->authenticate();
        $request->session()->regenerate();
        $user_type = Auth::user()->user_type;
        $token = Auth::user()->createToken('Personal Access Token')->plainTextToken;
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
            return redirect('/');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
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
}
