@extends('layouts/frontend/main')
@section('main-section')
<section class="dahboard-wrapper">
        <div class="container">
            <div class="row">
                
            @include('layouts/frontend/sidebar')

                <section class="middle col-md-6">
                    <div class="">
                        <div class="dashboard-heading">
                            <h3>Dashboard</h3>
                        </div>
                        <div class="row">
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
                        </div>

                        <div class="row all-product-dashboard">
                            <div class="col-md-6">
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">33</p>
                                    <p class="my-order-detail-name">Products in Your Cart</p>
                                </div>
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">33</p>
                                    <p class="my-order-detail-name">Products in Your Cart</p>
                                </div>
                                <div class="card my-order-detail">
                                    <p class="my-order-detail-quantity">33</p>
                                    <p class="my-order-detail-name">Products in Your Cart</p>
                                </div>
                            </div>
                            <div class="card recent col-md-6">
                                <div class="recent-heading">
                                    <h5>Recent Purchase History</h5>
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
                                    <div class="recent-products">
                                        <div class="recent-products-img">
                                            <img src="https://shop.activeitzone.com/public/uploads/all/eAyjUaOrohoDCUY4tR9SxpkcaqEBCxWw0uNjCSqi.png"
                                                alt="">
                                        </div>
                                        <div class="recent-products-content">
                                            <a href="">
                                                <p>ASUS ROG Phone 2 </p>
                                            </a>
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

                        <div class="row all-product-dashboard">
                            <div class="col-md-6">
                                <div class="add">
                                    <img src="https://shop.activeitzone.com/public/uploads/all/LgZLpm8qqUElgJtFcKu9CqyTdjrqc6VGA1dW8k7w.webp"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-md-6 card recent">
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
                </section> 

                <section class="col-md-3">
                    <div class="card address-default">
                        <h6>Default Shipping Address</h6>
                        <hr>
                        <p>4471 Nutters Barn Lane Des Moines, IA 50309</p>
                        <p>5252, Alabaster, Alabama</p>
                    </div>

                </section>
            </div>
        </div> 
    </section>

    @endsection