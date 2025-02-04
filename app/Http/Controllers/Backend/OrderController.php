<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Mail\OrderStatusUpdateMail;
use App\Mail\PlaceOrderMail;
use App\Models\Backend\Attribute;
use App\Models\Backend\AttributeValue;
use App\Models\Backend\BillingAddress;
use App\Models\Backend\DeliveryBoy;
use App\Models\Backend\Order;
use App\Models\Backend\OrderProduct;
use App\Models\Backend\ShippingAddress;
use App\Models\Backend\Stock;
use App\Models\Frontend\Cart;
use App\Models\User;
 
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
 

class OrderController extends Controller{
    public function index(){ 
        $orders = Order::select('*')->where('order_status', '!=', "not_confirmed");
        if(isset($_GET['payment_status']) && $_GET['payment_status'] != ''){
            $orders = $orders->where('payment_status', $_GET['payment_status']);
        }
        if(isset($_GET['delivery_status']) && $_GET['delivery_status'] != ''){
            $orders = $orders->where('order_status', $_GET['delivery_status']);
        }
        $orders = $orders->orderBy('id', 'desc')->paginate(10);
        return view('backend.order.index', compact('orders'));
    }

    public function edit($id){ 
        $delivery_boy_list = DeliveryBoy::where('status', 1)->get();
        $order = Order::with(['getOrderProduct:order_id,product_name,quantity,price,month,total_price,product_id,option_id,option_value_id', 'getOrderProduct.getProduct:id,product_images'])->where('id', $id)->first(); 
        // return $order;
        return view('backend.order.edit', compact('order', 'delivery_boy_list')); 
    }

    public function update(Request $request, $id){
        $payment_status = $request->payment_status;
        $order_status = $request->order_status;
        $discount = $request->discount; 
        $delivery_boy = $request->delivery_boy;
        $delivery_date = $request->delivery_date;
        $delivery_remark = $request->delivery_remark;
        $order_detail = Order::where('id', $id)->first();
 
        Order::where('id', $id)->update([
            "payment_status" => $payment_status,
            "order_status" => $order_status,
            "promo_discount" => $discount,
            "delivery_boy_id" => $delivery_boy,
            "delivery_date" => $delivery_date,
            "delivery_remark" => $delivery_remark,
        ]); 
        if($order_status == 'accepted'){
            if($order_detail != $order_status){
                Order::where('id', $id)->update([
                    "accepted_date" => Carbon::now()
                ]); 
            }
            $order_status_data = [
                "user_name" => $order_detail->shipping_name,
                "order_status" => "accepted", 
            ];
            Mail::to($order_detail->shipping_email)->send(new OrderStatusUpdateMail($order_status_data, "Your order has been accepted."));
        }elseif($order_status == 'canceled'){
            if($order_detail != $order_status){
                Order::where('id', $id)->update([
                    "canceled_date" => Carbon::now(),
                    "cancel_note" =>$request->cancel_note
                ]); 
            } 
            $order_status_data = [
                "user_name" => $order_detail->shipping_name,
                "order_status" => "canceled",
                "cancel_note" => $request->cancel_note
            ];
            Mail::to($order_detail->shipping_email)->send(new OrderStatusUpdateMail($order_status_data, "Your order has been canceled."));
            
            }elseif($order_status == 'shipped'){
                if($order_detail != $order_status){
                    Order::where('id', $id)->update([
                        "shipped_date" => Carbon::now(), 
                    ]); 
                } 
                $order_status_data = [
                    "user_name" => $order_detail->shipping_name,
                    "order_status" => "shipped", 
                ];
                Mail::to($order_detail->shipping_email)->send(new OrderStatusUpdateMail($order_status_data, "Your order has been shipped."));
            }elseif($order_status == 'delivered'){
                if($order_detail != $order_status){
                    Order::where('id', $id)->update([
                        "delivered_date" => Carbon::now(), 
                    ]); 
                }
                $order_status_data = [
                    "user_name" => $order_detail->shipping_name,
                    "order_status" => "delivered", 
                ];
                Mail::to($order_detail->shipping_email)->send(new OrderStatusUpdateMail($order_status_data, "Your order has been delivered."));
            }
 
        return redirect()->route('backend.order.index')->with('order_updated', "Order has been updated!");
    }

    public function placeOrder(Request $request){
        $payment_mode = $request->paymentMethod; 
        $admin_email = User::where('id', 1)->first()->email;
        // if($payment_mode == '1'){ 
            $shipping_charge = Session::get('shipping_charge');
            $cart_items = Cart::with('getProduct:id,product_name,tax_name,tax_rate', 'getStock')
            ->whereHas('getStock', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->where('user_id', Auth::user()->id)->get();
                
            $sub_total = 0;
            foreach ($cart_items as $item) {
                $sub_total += $item->price*$item->quantity;
            }
            $total = ($sub_total) + floatval($shipping_charge) + floatval($request->cgst) + floatval($request->sgst) + floatval($request->igst);
            
            $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
            $latest_order = Order::latest()->first();
            $new_order_id = $latest_order ? substr($latest_order->order_id, 3) + 1 : 1000001;
           
            $new_order_id = Order::create([
                    "user_id" => Auth::user()->id,
                    "order_id" => 'CCS'.$new_order_id,
                    "payment_mode" => $request->paymentMethod,
                    "delivery_charge" => $shipping_charge, 
                    "sub_total" => $sub_total,
                    "total" =>  floatval($total),
                    "billing_name" => $billing_address->name,
                    "shipping_name" => $shipping_address->name,
                    "billing_email" => $billing_address->email,
                    "billing_phone" => $billing_address->phone,
                    "shipping_email" => $shipping_address->email,
                    "shipping_phone" => $shipping_address->phone, 
                    "tax" => 0,
                    "cgst" => $request->cgst,
                    "sgst" => $request->sgst,
                    "igst" => $request->igst,
                    "payment_status" => "unpaid", 
                    "shipping_address" =>  $shipping_address->address.' '.$shipping_address->city.' '.$shipping_address->zip_code.' '.$shipping_address->country,
                    "billing_address" =>  $billing_address->address.' '.$billing_address->city.' '.$billing_address->zip_code.' '.$billing_address->country,
                    "ordered_date" => Carbon::now(),
                    "status" => 1
                    ])->id; 

                    $new_order_detail = Order::where('id', $new_order_id)->first();
 
                foreach ($cart_items as $item) {
                    $option_value = AttributeValue::where('id', $item->option_value_id)->first();
                    $option = Attribute::where('id', $item->option_id)->first();
                    OrderProduct::create([
                        "user_id" => Auth::user()->id,
                        "order_id" => $new_order_id,
                        "product_id" => $item->product_id,
                        "product_name" => $item->getProduct->product_name,
                        "quantity" => $item->quantity,
                        "price" => $item->price,
                        "month" => $item->month,
                        "option_id" => $option->name,
                        "option_value_id" => $option_value->name,
                        "total_price" => $item->price * $item->quantity,
                        "stock_id" => $item->stock_id
                    ]); 
                    $stock_item = Stock::findOrFail($item->stock_id);
                    if ($stock_item->quantity >= $item->quantity) { 
                        $stock_item->quantity -= $item->quantity; 
                        $stock_item->save(); 
                    }
                }
                

                if($payment_mode == '1'){
                    Session::forget('delivery_charge');
                $cart_items = Cart::with('getProduct:id,product_name')->where('user_id', Auth::user()->id)->delete(); 
                    Order::where('id', $new_order_id)->update([
                        "payment_method" => "cash_on_delivery",
                        "order_status" => "ordered", 
                    ]); 
                    
                    $place_order_data = [
                    "user_name" => Auth::user()->name,
                    "order_number" => $new_order_detail->order_id,
                    "order_date" => $new_order_detail->created_at,
                    "total" => $new_order_detail->total,
                    "product_list" => OrderProduct::where('order_id', $new_order_id)->get(),
                    "shipping_address" => ShippingAddress::where('user_id', Auth::user()->id)->first(),
                    "billing_address" => BillingAddress::where('user_id', Auth::user()->id)->first(),
                    "payment_method" => 1
                    ];

                Mail::to(Auth::user()->email)->send(new PlaceOrderMail($place_order_data, "Your order has been placed successfully"));
                Mail::to($admin_email)->send(new PlaceOrderMail($place_order_data, "Received new order."));
                $enc_order_id = Crypt::encryptString($new_order_id);
                return redirect('/order-detail/'.$enc_order_id)->with('new_order', 'order has been placed'); 
            }
            // code for order with payment gateways -------------------------------------------------------------------------------------------------
            else{  
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $order = $api->order->create([
                    'receipt' => '123',
                    'amount' => $total * 100,
                    'currency' => 'INR',
                    'payment_capture' => 1,
                ]);

                $new_order_detail = Order::where('id', $new_order_id)->update([
                    "payment_method" => "razorpay",
                    "order_status" => "not_confirmed", 
                    "razorpay_order_id" => $order['id']
                ]);
 
                $option = [
                    "key" => config('services.razorpay.key'),
                    "amount" => $order['amount'],
                    "currencty" => "INR",
                    "name" => Auth::user()->name,
                    "description" => "Order Description", 
                    "order_id" => $order['id'],
                    "theme" => [
                        "color" => "#3399cc"
                    ]
                ];
                
                return response()->json($option);
            }
            // code for order with payment gateways -----------------------------------------------------------------------------------------

        } 




    public function purchaseHistory(){
        $data['purchase_history'] = Order::with('getOrderProduct:order_id,product_name')
        ->where('user_id', Auth::user()->id)
        ->where('order_status', '!=', 'not_confirmed')
        ->withTrashed()
        ->orderBy('id', 'desc')->paginate(10); 
        return view('frontend.account.purchase_history', $data);
    }

    public function orderDetail($id){
        try{
        $order_id = Crypt::decryptString($id);
        $order = Order::with('getOrderProduct:order_id,product_id,product_name,price,total_price,quantity', 'getOrderProduct.getProduct:id,product_name,product_images')
        ->withTrashed()
        ->findOrFail($order_id);
        }catch(\Exception $e){
            abort(404);
        }
        // return $order;
        return view('frontend.account.order_detail', compact('order'));
    }

    public function destroy(Request $request){
        $id = $request->id;
        $product = Order::find($id);
        $delete_result = $product->delete();
        if($delete_result){
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'failed'
            ]);
        }
    }

    public function monthlySales(Request $request){
        try{
            $year = $request->year;
        $months = collect(range(1, 12))->map(function ($month) use ($year) {
            return Carbon::createFromDate($year, $month, 1)->format('Y-m');
        }); 
        // Get monthly sales data
         $monthlySales = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, IFNULL(SUM(total), 0) as total')
         ->whereYear('created_at', $year)
         ->groupBy('month')
         ->orderBy('month')
         ->pluck('total', 'month');
 
        $salesData = $months->map(function ($month) use ($monthlySales) {
            return $monthlySales->get($month, 0);
        })->toArray(); 
        return response()->json($salesData);
        }catch(\Exception $e){
            return response()->json([
                "message" => "something_went_wrong",
                "error" => $e->getMessage()
            ]);
        }
        
    }
    public function search(Request $request){
            $search_val = $request->search_val;
            if($search_val != ''){
                $search_result = Order::where('order_id', 'LIKE', '%'.$search_val.'%')
                ->orWhere('shipping_name', 'LIKE', '%'.$search_val.'%')->get();
            }else{
                $search_result = Order::orderBy('id', 'desc')->paginate(10);
            }
            $html = '';
            $count = 1;
            if($search_result->count() == 0){
                $html .= '<tr>';
                $html .= '<td class="text-center" style="display: table-cell;" colspan="4">No Result Found</td>';
                $html .= '</td>';
                $html .= '</tr>';
            }else{
                foreach($search_result as $search_data){
                    $html .= '';
                  $html .= '<tr id="row_id_'.$search_data->id.'">';
                    $html .= '<td>'.$search_data->order_id.'</td>';
                    $html .= '<td>'.$search_data->shipping_name.'</td>';
                    $html .= '<td>₹'.number_format($search_data->total - $search_data->promo_discount, 2).'</td>';
                    $html .= '<td>';
                        $html .= '<span class="text-capitalize">'.strtoupper($search_data->order_status).'</span>';
                    $html .= '</td> ';
                    $html .= '<td style="display: table-cell;">';
                        if($search_data->payment_status == 'paid'){
                            $html .= '<span class="badge badge-inline badge-success text-white p-2">'.strtoupper($search_data->payment_status).'</span>  ';
                        }else{
                            $html .= '<span class="badge badge-inline badge-danger p-2">'.strtoupper($search_data->payment_status).'</span>  ';
                        }
                    $html .= '</td>  ';
                    $html .= '<td class="footable-last-visible">';
                        $html .= '<a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="'.route('backend.order.edit', [$search_data->id]).'" title="View">';
                            $html .= '<i class="fa-regular fa-edit"></i>';
                        $html .= '</a>';
                        $html .= '<a class="btn btn-success btn-sm text-white" style="border-radius: 100px; background-color: #0abb75;" title="Print Invoice" href="'.route('backend.invoice.index', [$search_data->id]).'" id="printIcon" >';
                            $html .= '<i class="fa-solid fa-print" style="cursor: pointer;"></i>';
                        $html .= '</a> ';
                        $html .= '<button value="'.$search_data->id.'" class="btn btn-icon btn-sm delete_ico"';
                         $html .= 'id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>';
                         $html .= '</tr>';
                    $html .= '</td>'; 
                }
            }
            return $html;
    }

    public function sendInvoiceToCustomer(Request $request, $order_id){
        $order = Order::with(['getOrderProduct:order_id,product_name,quantity,price,month,total_price,product_id,option_id,option_value_id', 
        'getOrderProduct.getProduct:id,product_images,tax_name,tax_rate', 'getUser:id,name,email'])->where('id', $order_id)->first();
        $file_name = 'invoice_'.time().'.pdf';
        $html = view('backend.invoice.invoice_pdf', compact('order'))->render(); 
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html); 
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->render();  
        $pdfOutput = $dompdf->output();
        $filePath = 'invoices/'.$file_name; 
        $publicPath = public_path($filePath); 

        file_put_contents($publicPath, $pdfOutput);
        $invoice_mail_data  = [
            "customer_name" => $order->getUser?->name 
        ]; 
        $path = $publicPath;
        
        Mail::to($order->getUser?->email)
        ->send(new InvoiceMail($invoice_mail_data, $path, $file_name));  
        return redirect()->back()->with('invoice_sent', "The invoice successfully sent to customer.");
    }

    }
 
