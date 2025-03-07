<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        try{
            $reviews = Review::with(['getUser', 'getProduct'])->orderBy('id', 'desc')->paginate(10); 
            return view('backend.review.index', compact('reviews'));
        }catch(\Exception $e){
            return "Something went wrong.";
        }
    }

    public function submitReview(Request $request){
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $product_id = $request->product_id;
        $rating = $request->rating;
        $comment = $request->comment;
        $review_exist =Review::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
        if($review_exist){
            Review::where('user_id', Auth::user()->id)->where('product_id', $product_id)->update([
                "user_id" => Auth::user()->id,
                "product_id" => $product_id,
                "rating" => $rating,
                "comment" => $comment,
                "status" => 1
            ]);
        }else{
            Review::create([
                "user_id" => Auth::user()->id,
                "product_id" => $product_id,
                "rating" => $rating,
                "comment" => $comment,
                "status" => 1
            ]);
        }
        return redirect()->back()->with('review_sent', 'Review has been submitted successfully !');    
    }

    public function updateStatus(Request $request){
        try{ 
            $status = $request->status;
            $review_id = $request->review_id; 
            Review::where('id', $review_id)->update([
                "status" => $status,
            ]);
            return response()->json([
                "message" => "status_updated",
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => "something_went_wrong",
                "error" => $e->getMessage()
            ]);
        }

        
    }
 

}
