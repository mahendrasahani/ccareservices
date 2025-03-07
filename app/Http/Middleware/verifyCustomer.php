<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class verifyCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if(Auth::user()->otp_verify_status == 1 && Auth::user()->active_status == 1){
            return $next($request);
        }elseif(Auth::user()->otp_verify_status == 1 && Auth::user()->active_status == 0){
            Auth::guard('web')->logout(); 
            $request->session()->invalidate(); 
            $request->session()->regenerateToken(); 
            return redirect('/');
        }elseif(Auth::user()->otp_verify_status == 0 && Auth::user()->active_status == 1){
            return redirect('/otp-re-verify/'.Auth::user()->id);
        }elseif(Auth::user()->otp_verify_status == 0 && Auth::user()->active_status == 0){
            Auth::guard('web')->logout(); 
            $request->session()->invalidate(); 
            $request->session()->regenerateToken(); 
            return redirect('/');
        }
        else{ 
            return redirect('/');
        } 
    }
}
