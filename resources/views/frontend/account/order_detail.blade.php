@extends('layouts/frontend/main')
@section('main-section')
 <style>
            .hh-grayBox {
        background-color: #F8F8F8;
        margin-bottom: 20px;
        padding: 35px;
        margin-top: 20px;
    }

    .pt45 {
        padding-top: 45px;
    }

    .order-tracking {
        text-align: center;
        width: 33.33%;
        position: relative;
        display: block;
    }

    .order-tracking .is-complete {
        display: block;
        position: relative;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        border: 0px solid #AFAFAF;
        background-color: #f7be16;
        margin: 0 auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
        z-index: 2;
    }

    .order-tracking .is-complete:after {
        display: block;
        position: absolute;
        content: '';
        height: 14px;
        width: 7px;
        top: -2px;
        bottom: 0;
        left: 5px;
        margin: auto 0;
        border: 0px solid #AFAFAF;
        border-width: 0px 2px 2px 0;
        transform: rotate(45deg);
        opacity: 0;
    }

    .order-tracking.completed .is-complete {
        border-color: #27aa80;
        border-width: 0px;
        background-color: #27aa80;
    }

    .order-tracking.completed .is-complete:after {
        border-color: #fff;
        border-width: 0px 3px 3px 0;
        width: 7px;
        left: 11px;
        opacity: 1;
    }

    .order-tracking p {
        color: #A4A4A4;
        font-size: 16px;
        margin-top: 8px;
        margin-bottom: 0;
        line-height: 20px;
    }

    .order-tracking p span {
        font-size: 14px;
    }

    .order-tracking.completed p {
        color: #000;
    }

    .order-tracking::before {
        content: '';
        display: block;
        height: 3px;
        width: calc(100% - 40px);
        background-color: #f7be16;
        top: 13px;
        position: absolute;
        left: calc(-50% + 20px);
        z-index: 0;
    }

    .order-tracking:first-child:before {
        display: none;
    }

    .order-tracking.completed:before {
        background-color: #27aa80;
    }
 </style>

<section class="dahboard-wrapper">
    <div class="container">
        <div class="row">

            @include('layouts/frontend/sidebar')

            <section class="discount-wrapper col-md-9">
                <div class="dashboard-heading">
                    <h3>Order Code</h3>
                </div>
                <div class="order-details">
                    <h4> Summary </h4>
                    <div class="row p-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Order Code :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->order_id}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Name :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->shipping_name}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Email :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->shipping_email}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Shipping Address :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->shipping_address}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Total Order Amount :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>₹{{number_format($order->total, 2)}}/-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Payment Method :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->payment_method == 'cash_on_delivery' ? 'Cash On Delivery' : ''}}</p>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Delivery type :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>Standard</p>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Billing Address :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>{{$order->billing_address}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="track-order">
                    <div class="order-details">
                        <h4>The Shop</h4>
                    </div>
                    <div class="row p-2">
                        <div class="col-md-12 hh-grayBox pt45 pb20">
                            <div class="row justify-content-between">
                                <div class="order-tracking 
                                @if($order->order_status == 'ordered' || $order->order_status == 'shipped' || $order->order_status == 'delivered')
                                completed
                                @endif ">
                                    <span class="is-complete"></span>
                                    <p>Ordered<br><span>Mon, June 24</span></p>
                                </div>
                                <div class="order-tracking 
                                @if($order->order_status == 'shipped' || $order->order_status == 'delivered')
                                completed
                                @endif ">
                                    <span class="is-complete"></span>
                                    <p>Shipped<br><span>Tue, June 25</span></p>
                                </div>
                                <div class="order-tracking
                                @if($order->order_status == 'delivered')
                                completed
                                @endif  ">
                                    <span class="is-complete"></span>
                                    <p>Delivered<br><span>Fri, June 28</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="discount-details">
                        <table class="table-container">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th></th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                            @php 
                                $sn = 1;
                            @endphp
                            @foreach($order->getOrderProduct as $order_product)
                            <tr>
                                <td><b>{{$sn++}}</b></td>
                                <td class="recent-products-img">
                                    <img src="{{url($order_product->getProduct->product_images == '' ? 'public/assets/both/placeholder/product.jpg' : 'public/'.$order_product->getProduct->product_images[0])}}"alt="{{$order_product->getProduct->product_name    }}"
                                        alt=""> 
                                     </td>
 
                                <td class="track-order-name"> {{$order_product->product_name}}<br> <b>{{$order_product->option_value_id}}</b> </td>
                                <td><b>{{$order_product->quantity}}</b></td>
                                <td><b>₹{{number_format($order_product->price, 2)}}</b></td>
                                <td><b>₹{{number_format($order_product->total_price, 2)}}</b></td>
                            </tr>
                              @endforeach
                        </table>
                    </div>
                </div>

                    <div class="final-order">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="payment-seal" style="text-align: center;">
                                @if($order->payment_status == 'unpaid')

                                @elseif($order->payment_status == 'paid')
                                    <img src="https://shop.activeitzone.com/public/assets/img/paid_sticker.svg" alt="">
                                    @endif
                                </div> 
                            </div>
                            <div class="col-md-6 card p-4">
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Sub Total:</b></p>
                                        <p><b>₹{{number_format($order->sub_total, 2)}}</b></p>
                                    </div>
                                </div>
                                <!-- <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Tax :</b></p>
                                        <p><b>$224.10</b></p>
                                    </div>
                                </div> -->
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Shipping Charge :</b></p>
                                        <p><b>₹{{number_format($order->delivery_charge, 2)}}</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Coupon discount :</b></p>
                                        <p><b>₹{{number_format(0, 2)}}</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details total-final">
                                    <div class="single-order-final">
                                        <p><b>Total :</b></p>
                                        <p><b>₹{{number_format($order->total, 2)}}</b></p>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>


        </div>
    </div>
</section>




@endsection