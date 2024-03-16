<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
       return view('backend.vendor.index') ;
    }

    public function create(){
        return view('backend.vendor.create') ;
     }
    public function edit(){
        return view('backend.vendor.edit') ;
     } 
    
}
