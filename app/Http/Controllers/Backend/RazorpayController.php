<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\PlaceOrderMail;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class RazorpayController extends Controller
{
    public function createOrder(){
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => '123',
            'amount' => 100 * 100, // Amount in paise (₹100 = 10000 paise)
            'currency' => 'INR',
            'payment_capture' => 1, // Auto-capture payment
        ]);
        return view('frontend.account.payment_test', ['order' => $order]);
    }

    public function paymentSuccess(Request $request){
        $admin_email = User::where('id', 1)->first()->email;
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $payment = $api->payment->fetch($request->payment_id);
        $paymentDetails = $payment->toArray();
        if($paymentDetails['captured']){ 
            Session::forget('delivery_charge');
            $cart_items = Cart::with('getProduct:id,product_name')->where('user_id', Auth::user()->id)->delete(); 
            
            $order = Order::where('razorpay_order_id', $paymentDetails['order_id'])->first();
            Order::where('id', $order->id)->update([
                "payment_status" => "paid",
                "order_status" => "ordered",
                "payment_id" => $paymentDetails['id']
            ]);
            $place_order_data = [
                "user_name" => Auth::user()->name,
                "order_number" => $order->order_id,
                "order_date" => $order->created_at,
                "total" => $order->total,
                "product_list" => OrderProduct::where('order_id', $order->id)->get(),
                "shipping_address" => ShippingAddress::where('user_id', Auth::user()->id)->first(),
                "billing_address" => BillingAddress::where('user_id', Auth::user()->id)->first(),
                "payment_method" => 2
            ];
            Mail::to(Auth::user()->email)->send(new PlaceOrderMail($place_order_data, "Your order has been placed successfully"));
            Mail::to($admin_email)->send(new PlaceOrderMail($place_order_data, "Received new order."));
            $enc_order_id = Crypt::encryptString($order->id);
            return redirect('/order-detail/'.$enc_order_id)->with('new_order', 'order has been placed');
        }
    }
}
