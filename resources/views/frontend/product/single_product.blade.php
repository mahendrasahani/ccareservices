@extends('layouts/frontend/main')
@section('main-section') 
<section id="banner-image"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h2 class=" text-white pb-2 pt-5 text-center">{{$product_detail->product_name}}</h2>
                <nav aria-label="breadcrumb" style="margin: 0 auto;">
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">{{Str::title($main_category)}}</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">{{Str::title($sub_category)}}</a></li>
                        <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">{{$product_detail->product_name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> 
</section> 
<section>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6"> 
                <div class="wrapper">
                    <section class="mainImage">
                        <img src="{{$product_detail->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product_detail->product_images[0])}}" alt="">
                    </section>
                    
                    <section class="thumbnail">
                        <div>
                        @if($product_detail->product_images != '')

                            @foreach($product_detail->product_images as $key => $images)
                            <div class="thumbnailBox {{$key == 0 ? " active":""}}">
                                <img src="{{url('public/'.$images)}}" alt="">
                            </div>
                            @endforeach 
                            @else
                            <div class="thumbnailBox active">
                                <img src="{{url('public/assets/both/placeholder/product.jpg')}}" alt="">
                            </div>
                            @endif
                        </div>
                    </section>
                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-right-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reviews d-flex">
                                <div class="star mx-2">
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="review-counting d-flex mx-2">
                                    <p class="">0 Reviews |</p>
                                    <a href="#description" style="text-decoration:none;"><p class="" style="color:#01316b"> &nbsp Write a Review</p></a>
                                </div>
                            </div>
                            <div class="product-details">
                                <h1 class="fs-3">{{$product_detail->product_name}}</h1> 
                                <div class="available d-flex">
                                    <p class="mx-2">Availability:</p>
                                    @if($product_detail->getStock[0]['quantity'] == 0)<p class="text-danger" id="stock_status"> Out of Stock</p>
                                    @else
                                    <p class="text-success" id="stock_status"> In Stock</p>
                                    @endif
                                </div>
                            </div>
                            <div class="prpduct-price">
                                @if($product_detail->discount_type == 'flat')
                                <div class="aprice d-flex">
                                    <h4>₹ {{number_format($product_detail->regular_price -
                                        $product_detail->discount, 2)}} / Month</h4>
                                </div>
                                @elseif($product_detail->discount_type == 'percent')
                                <h4>₹ {{number_format($product_detail->regular_price -
                                    ($product_detail->regular_price * $product_detail->discount)/100, 2)}}
                                    / Month</h4>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="select-box">
                                    <input type="hidden" value="{{Crypt::encryptString($product_detail->id)}}" name="product_id" id="product_id">
                                    <label for="select-option" class="month-select mt-2">Delivery Date:</label> <br>
                                    <input type="date" id="delivery_date" name="delivery_date">
                                    <p  style="color:red; font-weight:bold;" id="date_error"></p> 
                                </div>
                                
                                <div class="product-quantity d-flex mt-3">
                                    <div class="mx-2 d-flex">
                                        <p class="mx-2 m-auto"> Qty</p>
                                        <input type="number" id="quantity" value="1" min="1"
                                            style="width: 20%; height: 30px;"> 
                                            <button type="button" class="single_product_btn" id="add_to_cart_btn">Add to Cart</button>
                                            <button type="button" class="single_product_btn ">Add to Wishlist</button>
                                        </div>
                                    </div>
                                    <p  style="color:red; font-weight:bold;" id="quantity_error"></p>
                            </div>
                            <div class="col-md-6">
                                <h6>{{$option_name}}</h6>
                                <div class="cap-btns" id="option_value_radio">
                                @foreach($product_detail->getStock as $index => $attribute_value)
                                        @php
                                            $attribute_value_name = App\Models\Backend\AttributeValue::where('id', $attribute_value->attribute_value_id)->first()->name;
                                        @endphp
                                        <input type="radio" id="option_{{$attribute_value->attribute_value_id}}" name="option_value" value="{{$attribute_value->attribute_value_id}}" {{$index == 0 ? 'checked':''}}>
                                        <label for="option_{{$attribute_value->attribute_value_id}}">{{$attribute_value_name}}</label>
                                    @endforeach
 
                                </div>
                                <div class="calculator card" id="range_slider_section">
                                    <label>Choose Tenure</label>
                                    <input type="range" min="1" max="12" value="1" id="slider" class="range_slider">
                                    <div class="numbers-container mt-2">
                                        <div class="number">1</div>
                                        <div class="number">2</div>
                                        <div class="number">3</div>
                                        <div class="number">4</div>
                                        <div class="number">5</div>
                                        <div class="number">6</div>
                                        <div class="number">7</div>
                                        <div class="number">8</div>
                                        <div class="number">9</div>
                                        <div class="number">10</div>
                                        <div class="number">11</div>
                                        <div class="number">12</div>
                                    </div> 
                                    <p>Price: <span id="show_price">{{number_format($product_detail->getStock[0]['price_1'], 2)}}/-</p>
                                    <input type="hidden" name="month" id="month" value="1">
                                     <input type="hidden" id="price" value="{{$product_detail->getStock[0]['price_1']}}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#description">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#myreview">Reviews</a>
            </li>
        </ul> 
        <div class="tab-content mt-2">
            <div class="tab-pane fade show active p-tag" id="description">
                <h6>SPECIFICATION﻿ / DESCRIPTION</h6>
                <p>Rating 3 star</p>
                <p>condition: good</p>
                <p>Brand of the product may vary</p>
                <p>Product may not be new, But it will be in good working condition</p> 
                <p>SECURITY...(CASH NIL) PDC (Post Dated Cheque) 31December 2024 Rs.7000. It will be returned back at the time of Pickup. Stabilizer charge extra 700 Rs if required. Transport charge extra 300 Rs. Submeter charge...500 if Required. Power Requirements:AC 230 V, 50 Hz. Pre installed plug point of 15 Amp should be available near ac.</p>
            </div>
            <div class="tab-pane fade" id="myreview">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Leave a review</h6>
                        <form id="reviewForm"> 
                            <div class="reviews d-flex">
                                <label for="review"
                                    style="display: flex;justify-content: center;align-items: center;">Your Review:</label>
                                <fieldset class="rating"> 
                                    <input type="checkbox" id="star5" name="rating" value="5">
                                    <label class="full" for="star5"><i class="fas fa-star"></i></label>
                                    <input type="checkbox" id="star4" name="rating" value="4">
                                    <label class="full" for="star4"><i class="fas fa-star"></i></label>
                                    <input type="checkbox" id="star3" name="rating" value="3">
                                    <label class="full" for="star3"><i class="fas fa-star"></i></label>
                                    <input type="checkbox" id="star2" name="rating" value="2">
                                    <label class="full" for="star2"><i class="fas fa-star"></i></label>
                                    <input type="checkbox" id="star1" name="rating" value="1">
                                    <label class="full" for="star1"><i class="fas fa-star"></i></label>
                                </fieldset>
                            </div>
                            <textarea id="review" name="review" placeholder="Write your review here..." cols="50"
                                class="mt-2 p-2"></textarea><br>
                            <button type="button" class="btn btn-warning animation  mx-2">Submit Review</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h6>Reviews by customers</h6>
                        <div class="single-review">
                            <div class="rev-img">
                                <img src="https://pbs.twimg.com/profile_images/1701878932176351232/AlNU3WTK_400x400.jpg" alt="">
                            </div>
                            <div class="full-rev">  
                                    <div class="star ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>  
                                    <div class="rev-name"><b>Kartik Sharma</b></div>
                                    <div class="rev-content">
                                        <p>One of the standout features of the LunarGlow is its customizable lighting options. With adjustable brightness and color settin</p>
                                     </div> 
                             </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>  
    </div>
</section> 
@section('javascript-section')
  

@endsection
@endsection