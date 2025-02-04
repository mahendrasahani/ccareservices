@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h4">Order Details</h2>
                            <div class="">
                            <form method="POST" action="{{route('backend.order.update', [$order->id])}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h2 class="h6 font-size-16 font-weight-bold mb-0"> Order Code: {{$order->order_id}}</h2>
                                    </div>
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <div class="row">
                                            <div class="col-md mb-3">
                                                <div>
                                                    <div class="font-size-10 font-weight-bold mb-2" style="font-size: 12px;">Customer info</div>
                                                    <div style="font-size: 12px;"><span class="opacity-80 mr-2 ml-0">Name:</span> {{$order->shipping_name}}</div>
                                                    <div style="font-size: 12px;"><span class="opacity-80 mr-2 ml-0">Email:</span> {{$order->shipping_email}}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-xl-4" style="font-size: 12px;">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td class="">Order Code:</td>
                                                            <td class="text-right text-info font-weight-bold">{{$order->order_id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Order Date:</td>
                                                            <td class="text-right font-weight-bold">{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>

                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="">Payment Method:</td>
                                                            <td class="text-right font-weight-bold">{{$order->payment_method == "cash_on_delivery" ? "Cash On Delivery" : "Online"}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <div class="row align-items-start">
                                            <div class="col-md-4" style="font-size: 12px;">
                                                <div class="mb-3">
                                                    <label class="mb-0">Payment Status</label>
                                                    <select class="form-control" id="payment_status" name="payment_status" style="font-size: 12px;">
                                                        <option value="paid" {{$order->payment_status == "paid" ? "selected" : ""}}>Paid</option>
                                                        <option value="unpaid" {{$order->payment_status == "unpaid" ? "selected" : ""}}>Unpaid</option>
                                                    </select>
                                                </div>


                                                <div class="mb-3" id="order_status_area">
                                                    <label class="mb-0">Order Status</label>
                                                    <select class="form-control" id="order_status" name="order_status" style="font-size: 12px;">
                                                        <option value="ordered" {{$order->order_status == "ordered" ? "selected" : ""}}>Ordered</option> 
                                                        <option value="accepted" {{$order->order_status == "accepted" ? "selected" : ""}}>Accept</option> 
                                                        <option value="canceled" {{$order->order_status == "canceled" ? "selected" : ""}}>Cancel</option> 
                                                        <option value="shipped" {{$order->order_status == "shipped" ? "selected" : ""}}>Shipped</option> 
                                                        <option value="delivered" {{$order->order_status == "delivered" ? "selected" : ""}}>Delivered</option> 
                                                    </select>
                                                </div>  
                                                @if($order->order_status == 'canceled')
                                                <div class="mb-3" id="cancel_note_area">
                                                    <label class="mb-0">Cancel Note</label>
                                                    <input type="text" id="cancel_note" name="cancel_note" class="form-control" placeholder="Cancel Note" value="{{$order->cancel_note ?? ''}}">
                                                </div>
                                                @endif


                                                 <div class="mb-3">
                                                    <label for="assign_deliver_boy">Assign Deliver Boy</label>
                                                    <select class="form-control" id="delivery_boy" name="delivery_boy" style="font-size: 12px;">
                                                        <option value="" selected>Select Delivery Boy</option>
                                                        @foreach($delivery_boy_list as $delivery_boy)
                                                        <option value="{{$delivery_boy->id}}" {{$order->delivery_boy_id == $delivery_boy->id ? "selected" : ""}}>{{$delivery_boy->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="delivery_date">Delivery Date</label>
                                                     <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ isset($order->delivery_date) ? \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d') : '' }}" required>
                                                </div>
                                                 <div class="mb-3">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea name="delivery_remark" id="delivery_remark" class="form-control">{{$order->delivery_remark ?? ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4 " style="font-size: 12px;">
                                                <h5 class="font-size-14 mb-3">Shipping Address</h5>
                                                <address> 
                                                    {{$order->shipping_address}} 
                                                </address>
                                            </div>
                                            <div class="col-md-4" >
                                                <h5 class="h6 font-size-14 mb-3">Billing Address</h5>
                                                <address>
                                                {{$order->billing_address}} 
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th>#</th>
                                                    <th width="40%">Product</th>
                                                    <th>QTY</th>
                                                    <th>Month</th>
                                                    <th>Unit price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($order->getOrderProduct as $product)
                                                <tr style="font-size: 12px;">
                                                    <td>1</td>
                                                    <td>
                                                        <div class="media"> 
                                                            <img src="{{$product->getProduct->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->getProduct->product_images[0])}}" class="" width="20%"> 
                                                            <div class="media-body mx-2">
                                                                <h4 class="h6 font-size-8 font-weight-">{{$product->product_name}}</h4>
                                                                <div>
                                                                    <span class="mr-2">
                                                                        <span class="opacity-50">{{$product->option_id}}</span>: {{$product->option_value_id}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$product->quantity}}</tdlass=>
                                                    <td>{{$product->month}} Months</td>
                                                    <td>₹{{number_format($product->price, 2)}}</td>
                                                    <td>₹{{number_format($product->total_price, 2)}}</td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Sub Total :</strong></td>
                                                            <td>₹{{number_format($order->sub_total, 2)}}</td>
                                                        </tr> 
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Shipping :</strong></td>
                                                            <td>₹{{number_format($order->delivery_charge, 2)}}</td>
                                                        </tr>

                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">CGST :</strong></td>
                                                            <td>₹{{number_format($order->cgst, 2)}}</td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">SGST :</strong></td>
                                                            <td>₹{{number_format($order->sgst, 2)}}</td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">IGST :</strong></td>
                                                            <td>₹{{number_format($order->igst, 2)}}</td>
                                                        </tr>


                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Discount :</strong></td>
                                                            <td><input type="number" name="discount" id="discount" min="0" value="{{$order->promo_discount ?? '0'}}"></td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Total :</strong></td>
                                                            <input type="hidden" id="total_price" name="total_price" value="{{$order->total}}">
                                                            <td class="h6" id="showFinalPrice">₹{{number_format($order->total - $order->promo_discount, 2)}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                 
                                                <input type="submit" value="Update Order" class="btn btn-primary" style="background-color: #f5a100;border:0;" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                            <!-- <div class="col col-lg-auto w-lg-300px">
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h3 class="h6 font-size-16 mb-0">Tracking information</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <input type="hidden" name="_token" value="tJMcCHinI3PcvyeD67lcGCBH3nx1h1b5U6IWyUuR">
                                            <input type="hidden" name="order_id" value="226">
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Courier name:</label>
                                                <input type="text" class="form-control form-control-sm" name="courier_name" value="" required="">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Tracking number:</label>
                                                <input type="text" class="form-control form-control-sm" name="tracking_number" value="" required="">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Tracking URL:</label>
                                                <input type="text" class="form-control form-control-sm" name="tracking_url" value="" required="">
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h3 class="h6 font-size-16 mb-0">Order updates</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="p-2 bg-light rounded">
                                                Order status updated to confirmed.
                                            </div>
                                            <span class="font-size-12 opacity-60">by Admin at 10:13pm, 29-10-2023</span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="p-2 bg-light rounded">
                                                Order has been placed.
                                            </div>
                                            <span class="font-size-12 opacity-60">by Christina Ashens at 05:15am, 27-09-2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #/ container end-->
        </div>



@section('javascript-section') 
<script> 
     $(document).ready(function(){
        $(document).on("click", "#discount", calculateDiscount);

        $(document).on("keyup", "#discount", calculateDiscount);
     });
    function calculateDiscount(){
        let discountPrice = $(this).val(); 
        let totalPrice = $("#total_price").val(); 
        let finalPrice = totalPrice - discountPrice;
        let formattedFinalPrice = '₹' + finalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');  
        $('#showFinalPrice').text(formattedFinalPrice); 
        // $("#total_price").val(finalPrice); 

    }
</script> 

    <script> 
        $(document).on("change", "#order_status", function(){
            let order_status = $(this).val();
            let cancel_note_val = $("#cancel_note").val();
            if(order_status == 'canceled'){
                $(`<div class="mb-3" id="cancel_note_area">
                   <label class="mb-0">Cancel Note</label>
                   <input type="text" id="cancel_note" name="cancel_note" class="form-control" value="${cancel_note_val == undefined ? '':cancel_note_val}" placeholder="Cancel Note">
               </div>`).insertAfter('#order_status_area');
            }else{
                $('#cancel_note_area').remove();
            }
        });
    </script>
@endsection



@endsection