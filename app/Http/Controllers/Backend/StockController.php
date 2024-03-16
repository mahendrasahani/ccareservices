<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return view('backend.stock.index');
    }

    public function create()
    {
        return view('backend.stock.create');
    }
    public function edit()
    {
        return view('backend.stock.edit');
    }
}
