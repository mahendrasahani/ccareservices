@extends('layouts/frontend/main')
@section('main-section')
<section class="dahboard-wrapper">
        <div class="container">
            <div class="row">
                
            @include('layouts/frontend/sidebar')

                <section class="middle col-md-9">
                    <div class="">
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
                            <div class="col-md-4">
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">{{$total_products_in_cart ?? 0}}</p>
                                    <p class="my-order-detail-name">Total Products in Your Cart</p>
                                </div>
                            </div>
                                
                            <div class="col-md-4">
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">33</p>
                                    <p class="my-order-detail-name">Total Products in Your Wishlist</p>
                                </div>
                            </div>
                                
                            <div class="col-md-4">
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">{{$total_products_in_order_list ?? 0}}</p>
                                    <p class="my-order-detail-name">Total Products in Your Order List</p>
                                </div>
                            </div>
                                 

                            
                        </div>
                        
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="card recent">
                                                        <div class="recent-heading">
                                                            <h5>Recent Purchase History</h5>
                                                        </div>
                                                        <hr>
                                                        <div class="recent-products-wrapper">
                                                        @if(count($recent_purchase_history) != 0)
                                    @foreach($recent_purchase_history as $recent_purchase)
                                    <div class="recent-products">
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
                            </div>

                   <div class="col-md-6">
                           <div class="card recent">
                                <div class="recent-heading">
                                    <h5>My Wishlist</h5>
                                </div>
                                <hr>
                                <div class="recent-products-wrapper">
                                        <div class="recent-products">
                                            <div class="recent-products-img">
                                                <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                    alt="">
                                            </div>
                                            <div class="recent-products-content">
                                                <a href=""><p>ASUS ROG Phone 2 </p></a>
                                                <span>$301.00</span>
                                            </div>
                                        </div>
                                        <div class="recent-products">
                                            <div class="recent-products-img">
                                                <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                    alt="">
                                            </div>
                                            <div class="recent-products-content">
                                                <a href=""><p>ASUS ROG Phone 2 </p></a>
                                                <span>$301.00</span>
                                            </div>
                                        </div>
                                        <div class="recent-products">
                                            <div class="recent-products-img">
                                                <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                    alt="">
                                            </div>
                                            <div class="recent-products-content">
                                                <a href=""><p>ASUS ROG Phone 2 </p></a>
                                                <span>$301.00</span>
                                            </div>
                                        </div>
                                        <div class="recent-products">
                                            <div class="recent-products-img">
                                                <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                    alt="">
                                            </div>
                                            <div class="recent-products-content">
                                                <a href=""><p>ASUS ROG Phone 2 </p></a>
                                                <span>$301.00</span>
                                            </div>
                                        </div>
                                        <div class="recent-products">
                                            <div class="recent-products-img">
                                                <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                    alt="">
                                            </div>
                                            <div class="recent-products-content">
                                                <a href=""><p>ASUS ROG Phone 2 </p></a>
                                                <span>$301.00</span>
                                            </div>
                                        </div> 
                                </div>
                            </div>
                       </div>
                        </div>
 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card address-default mt-4">
                                <h6>Default Shipping Address</h6>
                                <hr>
                                @if($default_shipping_address != '')
                                <p>{{$default_shipping_address->address}}, {{$default_shipping_address->city}}</p>
                                <p>{{$default_shipping_address->zip_code}} - {{$default_shipping_address->country}}</p>
                                @endif
                            </div> 
                         </div>
                    </div>
                    </div>
                </section> 

                
            </div>
        </div> 
    </section>

    @endsection