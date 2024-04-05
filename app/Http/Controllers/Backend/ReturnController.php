<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(){
        return view('backend.return.index');
    }
    public function edit(){
        return view('backend.return.edit');
    }
    public function view(){
        return view('backend.return.view');
    }
    public function create(){
        return view('backend.return.create');
    }
}
