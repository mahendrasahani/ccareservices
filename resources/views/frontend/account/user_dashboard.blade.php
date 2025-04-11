@extends('layouts/frontend/main')
@section('main-section')
<section class="dahboard-wrapper">
        <div class="container">
            <div class="row">
                
            @include('layouts/frontend/sidebar')

                <section class="middle col-md-9"> 
                        <div class="dashboard-heading">
                            <h3>Dashboard</h3>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="dashboard-content">
                                    <div class="balance">
                                        <div class="account">
                                            <p class="account-name">Wallet Balance</p>
                                            <p class="account-balance">Rs. 7654</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dashboard-content">
                                    <div class="balance">
                                        <div class="account">
                                            <p class="account-name">Wallet Balance</p>
                                            <p class="account-balance">Rs. 7654</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="card my-order-detail ">
                                    <div class="my_order_content">
                                        <p class="my-order-detail-quantity">{{$total_products_in_cart ?? 0}}</p>
                                    <p class="my-order-detail-name">Total Products in Your Cart</p>
                                    </div> 
                                </div>
                            </div>
                                
                           
                                
                            <div class="col-md-6">
                                <div class="card my-order-detail ">
                                    <div class="my_order_content">
                                        <p class="my-order-detail-quantity">{{$total_products_in_order_list ?? 0}}</p>
                                    <p class="my-order-detail-name">Total Products in Your Order List</p>
                                    </div> 
                                </div>
                            </div> 
                            
                     
                         
                        
                            <div class=" col-md-12">
                                <div class="card recent">
                                        <div class="recent-heading">
                                            <h5>Recent Purchase History</h5>
                                        </div>
                                        <hr>
                                        <div class="recent-products-wrapper">
                                        @if(count($recent_purchase_history) != 0)
                                    @foreach($recent_purchase_history as $recent_purchase)
                                    <div class="recent-products pt-2 mt-2" style="border: 1px solid rgb(0 0 0 / 18%);">
                                        <div class="recent-products-img mx-2">
                                            <img src="{{url($recent_purchase->getProduct->product_images == '' ? 'public/assets/both/placeholder/product.jpg' : 'public/'.$recent_purchase->getProduct->product_images[0])}}"alt="{{$recent_purchase->getProduct->product_name ?? ''}}">
                                        </div>
                                        <div class="recent-products-content">
                                            <a href=""><p>{{$recent_purchase->getProduct->product_name}}</p></a>
                                            <span>₹{{number_format($recent_purchase->price, 2)}}/-</span>
                                        </div>
                                    </div> 
                                    @endforeach
                                    @else
                                    <p>No purchase history</p>
                                    @endif

                                                        </div>
                                </div>

                                <div class="card address-default mt-4">
                                <h6>Default Shipping Address</h6>
                                <hr>
                                @if($default_shipping_address != '')
                                <p>{{$default_shipping_address->address}},</p>
                                <p>{{$default_shipping_address->city}}</p>
                                @endif
                            </div>
                            </div>  
                               </div> 
                </section> 

                
            </div>
        </div> 
    </section>

    @endsection