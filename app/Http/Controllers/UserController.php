<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function verifyUser(){
        if(auth()->check()){
            return response()->json([
                'status' => 200,
                'authentication' => true
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'authentication' => false
            ]);
        }
    }

    
}
