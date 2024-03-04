<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Cart;
use Auth;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function showCart(){ 
        return view('frontend.cart', compact('cart'));
    }

    public function addToCart(Request $request){
        $product_id = isset($request->product_id) ? (int)Crypt::decryptString($request->product_id) : 0;
        $quantity = isset($request->quantity) ? (int)$request->quantity : 1; 
        $delivery_date = $request->delivery_date; 
        $option_value_id = $request->option_value_id;
        $month = $request->month;
        $price = $request->price;
        $authentication = $request->authentication; 
        // $cart = session()->get('cart'); 
        if($authentication == "false"){
        $cart = session()->get('cart');  
            if ($quantity == 0){
                echo json_encode(array());
                die;
            }  
            if (!$cart){
                $cart = array();
            }  
            if($cart != '') { 
                $updated = false;
                foreach($cart as $index => $item) {
                    if($item['product_id'] == $product_id) { 
                        $cart[$index]['product_id'] = $product_id;
                        $cart[$index]['quantity'] = $quantity;
                        $cart[$index]['price'] = $price;
                        $cart[$index]['delivery_date'] = $delivery_date;
                        $cart[$index]['month'] = $month;
                        $updated = true;
                        break;
                    }
                }

                if (!$updated){ 
                    $newItem = array(
                                     'product_id' => $product_id,
                                     'quantity' => $quantity,
                                     'price' => $price,
                                     'delivery_date' => $delivery_date,
                                     'option_value_id' => $option_value_id,
                                     'month' => $month, 
                    );
                    $cart[] = $newItem;
                }

                } 

            session()->put('cart', $cart); 
            $data = session()->get('cart'); 
        } else{ 
        $cart = session()->get('cart'); 
            if($cart != '') {
                foreach($cart as $index => $item) {
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $cart[$index]['product_id'],
                        'quantity' => $cart[$index]['quantity'],  
                        'delivery_date' => $cart[$index]['delivery_date'],
                        'option_value_id' => $cart[$index]['option_value_id'],
                        'month' => $cart[$index]['month'],
                        'price' => $cart[$index]['price'],
                        'status' => 1
                    ]); 
                } 
            }else{

                $product = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first();
                if($product){
                    Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->update([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'delivery_date' => $delivery_date,
                    'option_value_id' => $option_value_id,
                    'month' => $month,
                    'price' => $price,
                    'status' => 1
                    ]); 
                }else{
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'delivery_date' => $delivery_date,
                    'option_value_id' => $option_value_id,
                    'month' => $month,
                    'price' => $price,
                    'status' => 1
                ]); 
            } 
            }
            
            
            $data = Cart::where('user_id', Auth::user()->id)->get();
        } 

        return response()->json([
            'status' => 200,
            'message' => "Added into cart", 
            'authentication' => $authentication,
            'data' => $data, 
    ]);
    

    }

    public function updateCartOnLoad(Request $request){
       
        if(Auth::check()){ 
            $cart = Cart::where('user_id', Auth::user()->id)->get(); 
            return response()->json([
                'status' => 200,
                'message' => "Added into cart", 
                'authentication' => $request->authentication,
                'data' => $cart, 
        ]); 
        }else{ 
            $cart = session()->get('cart'); 
            if (!$cart) {
                return response()->json([
                    'status' => 200,
                    'message' => "Added into cart", 
                    'authentication' => $request->authentication, 
                    'data' => ''
            ]);
            } else{ 
            return response()->json([
                'status' => 200,
                'message' => "Added into cart", 
                'authentication' => $request->authentication,
                'data' => $cart, 
        ]);
        }
}
    
    }
    
    function testingFlushCart(Request $request){
        $request->session()->flush(); 
        return redirect()->back();
    }

}
