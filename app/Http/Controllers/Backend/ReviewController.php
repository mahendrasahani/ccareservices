<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        return view('backend.review.index');
    }

    public function submitReview(Request $request){
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);
        
        $rating = $request->rating;

        return $rating;
    }
}
