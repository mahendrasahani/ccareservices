@extends('layouts/frontend/main')
@section('main-section')
<!-- slider banner srart -->
<section class="owl-carousel" id="owl-carousel">
  <div class="item"><img src="{{url('public/assets/frontend/images/coolcare-banner-1920x685.jpg')}}" alt="Image 1">
  </div>
  <div class="item"><img src="{{url('public/assets/frontend/images/coolcare-banner-1920x685.jpg')}}" alt="Image 2">
  </div>
  <!-- Add more items as needed -->
</section>
<!-- Heading tag  -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center heading">
          Home Appliances On Rent In Gurgaon- Appliance Rental Services
        </h1>
       </div>

    </div>
  </div>
  <!-- spport section -->
  <div class="wrapper d-flex justify-content-center mt-3">
    <div class="card-fist service">
      <svg class="icon icon-like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <path
          d="M24.85 10.126C26.868 5.343 31.478 2 36.84 2c7.223 0 12.425 6.18 13.08 13.544 0 0 .352 1.828-.425 5.12-1.058 4.48-3.545 8.463-6.898 11.502L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.02-6.898-11.503-.777-3.29-.424-5.12-.424-5.12C.734 8.18 5.936 2 13.16 2c5.362 0 9.672 3.343 11.69 8.126z" />
      </svg>
      <svg class="icon icon-bookmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.481 19.481">
        <path
          d="M10.2.758l2.48 5.865 6.343.545c.44.038.62.587.285.876l-4.812 4.17 1.442 6.2c.1.432-.367.77-.745.542L9.74 15.668l-5.45 3.288c-.38.228-.846-.11-.746-.54l1.442-6.203-4.813-4.17c-.334-.29-.156-.838.285-.876l6.344-.545L9.28.758c.172-.408.75-.408.92 0z" />
      </svg>
      <img class="person_img" src="{{url('public/assets/frontend/images/icon/free-instalation1.png')}}" alt="">
      <p class="person_name">Free Repair And Maintenance</p>
    </div>
    <div class="card-fist service">
      <svg class="icon icon-like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <path
          d="M24.85 10.126C26.868 5.343 31.478 2 36.84 2c7.223 0 12.425 6.18 13.08 13.544 0 0 .352 1.828-.425 5.12-1.058 4.48-3.545 8.463-6.898 11.502L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.02-6.898-11.503-.777-3.29-.424-5.12-.424-5.12C.734 8.18 5.936 2 13.16 2c5.362 0 9.672 3.343 11.69 8.126z" />
      </svg>
      <svg class="icon icon-bookmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.481 19.481">
        <path
          d="M10.2.758l2.48 5.865 6.343.545c.44.038.62.587.285.876l-4.812 4.17 1.442 6.2c.1.432-.367.77-.745.542L9.74 15.668l-5.45 3.288c-.38.228-.846-.11-.746-.54l1.442-6.203-4.813-4.17c-.334-.29-.156-.838.285-.876l6.344-.545L9.28.758c.172-.408.75-.408.92 0z" />
      </svg>
      <img class="person_img" src="{{url('public/assets/frontend/images/icon/wabrapper2.png')}}" alt="">
      <p class="person_name">Online Support 24/7</p>

    </div>

    <div class="card-fist service">
      <svg class="icon icon-like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <path
          d="M24.85 10.126C26.868 5.343 31.478 2 36.84 2c7.223 0 12.425 6.18 13.08 13.544 0 0 .352 1.828-.425 5.12-1.058 4.48-3.545 8.463-6.898 11.502L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.02-6.898-11.503-.777-3.29-.424-5.12-.424-5.12C.734 8.18 5.936 2 13.16 2c5.362 0 9.672 3.343 11.69 8.126z" />
      </svg>
      <svg class="icon icon-bookmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.481 19.481">
        <path
          d="M10.2.758l2.48 5.865 6.343.545c.44.038.62.587.285.876l-4.812 4.17 1.442 6.2c.1.432-.367.77-.745.542L9.74 15.668l-5.45 3.288c-.38.228-.846-.11-.746-.54l1.442-6.203-4.813-4.17c-.334-.29-.156-.838.285-.876l6.344-.545L9.28.758c.172-.408.75-.408.92 0z" />
      </svg>
      <img class="person_img" src="{{url('public/assets/frontend/images/icon/customer-satisfaction.png')}}" alt="">
      <p class="person_name">100 % Customer Satisfaction</p>

    </div>

    <div class="card-fist service">
      <svg class="icon icon-like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <path
          d="M24.85 10.126C26.868 5.343 31.478 2 36.84 2c7.223 0 12.425 6.18 13.08 13.544 0 0 .352 1.828-.425 5.12-1.058 4.48-3.545 8.463-6.898 11.502L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.02-6.898-11.503-.777-3.29-.424-5.12-.424-5.12C.734 8.18 5.936 2 13.16 2c5.362 0 9.672 3.343 11.69 8.126z" />
      </svg>
      <svg class="icon icon-bookmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.481 19.481">
        <path
          d="M10.2.758l2.48 5.865 6.343.545c.44.038.62.587.285.876l-4.812 4.17 1.442 6.2c.1.432-.367.77-.745.542L9.74 15.668l-5.45 3.288c-.38.228-.846-.11-.746-.54l1.442-6.203-4.813-4.17c-.334-.29-.156-.838.285-.876l6.344-.545L9.28.758c.172-.408.75-.408.92 0z" />
      </svg>
      <img class="person_img" src="{{url('public/assets/frontend/images/icon/free-instalation1.png')}}" alt="">
      <p class="person_name">Free Installation</p>

    </div>
    <div class="card-fist service">
      <svg class="icon icon-like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
        <path
          d="M24.85 10.126C26.868 5.343 31.478 2 36.84 2c7.223 0 12.425 6.18 13.08 13.544 0 0 .352 1.828-.425 5.12-1.058 4.48-3.545 8.463-6.898 11.502L24.85 48 7.402 32.165c-3.353-3.038-5.84-7.02-6.898-11.503-.777-3.29-.424-5.12-.424-5.12C.734 8.18 5.936 2 13.16 2c5.362 0 9.672 3.343 11.69 8.126z" />
      </svg>
      <svg class="icon icon-bookmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.481 19.481">
        <path
          d="M10.2.758l2.48 5.865 6.343.545c.44.038.62.587.285.876l-4.812 4.17 1.442 6.2c.1.432-.367.77-.745.542L9.74 15.668l-5.45 3.288c-.38.228-.846-.11-.746-.54l1.442-6.203-4.813-4.17c-.334-.29-.156-.838.285-.876l6.344-.545L9.28.758c.172-.408.75-.408.92 0z" />
      </svg>
      <img class="person_img" src="{{url('public/assets/frontend/images/icon//1321.png')}}" alt="">
      <p class="person_name">Secure Payment</p>
      <span class="short">All cards accepted</span>
    </div>
  </div>
</section>
<!-- spport section end -->
<!--  product  start -->
<section>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center position-relative  mb-5 mt-5" id="before">
          <img src="{{url('public/assets/frontend/images/icon/apps.png')}}" class="bg-white">
          <h4 class="bg-white" style="color: #656565; font-size: 17px;">&nbsp&nbspProducts on sale&nbsp</h4>
        </div>
        <div class="row">

        @foreach($main_categories as $main)
        @if(count($main->subCategory) > 0)
        @foreach($main->subCategory as $sub)
          <div class="col-md-3" id="media-product">
            <div class="card hover-item">
              <a href="{{route('frontend.product.product_list', [Str::slug($main->slug), Str::slug($sub->slug)])}}" class="text-decoration-none">
                @if($sub->thumbnail_image != '')
                <img src="{{url($sub->thumbnail_image)}}" class="card-img-top" alt="...">
                @else
                <img src="{{url('public/assets/both/placeholder/product.jpg')}}" class="card-img-top" alt="...">
                @endif
                <div class="card-body" style="padding: 7px;">
                  <h6 class="card-title text-center  categry">{{$sub->name}} ON RENT</h6>
                </div>
              </a>
            </div>
          </div>
          @endforeach
          @endif
          @endforeach
        </div>
      </div>
       
      <!--button toggle-->
       
      <div class="col-md-12 mt-5 mb-2">
        <a href="#" class="text-decoration-none" >
          <button class="animate-btx animate-btx-home" style="margin: 0px auto;" id="show-hidden-menu">
            View More 
            <span id="arrow-icon"></span>
          </button>
        </a>
      </div>
      <!--button toggle end-->
    </div>
  </div>
</section>
<!-- product  end -->
<!-- footer slider start -->
<section>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center position-relative  mb-5 mt-5" id="before">
          <img src="{{url('public/assets/frontend/images/icon/trend.png')}}" class="bg-white">
          <h4 class="bg-white" style="color: #656565; font-size: 17px;">&nbsp&nbspTrending Products&nbsp</h4>
        </div>
      </div>
      <div id="my-unique-carousel" class="owl-carousel">

        @foreach($product_list as $product)
        <div class="card">
          <img
            src="
            @if($product->product_images != '' || $product->product_images != null)
            {{url('public/'.$product->product_images[0])}}
            @else
            {{url('public/assets/both/placeholder/product.jpg')}}
            @endif 
            "
            class="card-img-top" alt="..."> 
          <div class="card-body">
            <div class="d-flex justify-content-between align-content-center" style="height: 41px;">
              <a href="#" class="text-decoration-none">
                <p class="text-dark title">{{$product->product_name}}</p>
              </a>
              <div class="block flex-shrink-0 ml-2">
                <i class="fa-solid fa-truck time"></i>
              </div>
            </div>
            <!-- <div class="d-flex justify-content-lg-between">
              <p class="mb-0">
                <span class="old-price">₹ 1,677 </span>
                <span class="new-price">₹ 1,427/mo</span>
              </p>
              <p class="offer">-15% OFF</p>
            </div> -->
            <div class="d-flex justify-content-between">
              <a href="{{route('frontend.product.single_product', [$product->slug])}}"><button type="button" class="btn btn-warning animation">View More</button></a>
            </div>
          </div>
        </div>
        @endforeach


         
         
         
      </div>
    </div>
  </div>
</section>
<!--slider emd-->
<!--collapese start-->
<section>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <img src="{{url('public/assets/frontend/images/pexels-nataliya-vaitkevich-6214476.jpg')}}" class="w-100 mt-5">
      </div>
      <div class="col-md-6 " class="text-center">
        <div class="card" style="    border: none;  ">
          <div class="card-header change-one" style="border:none;">
            <h3>Why CoolCare Services?</h3>
          </div>
          <div class="cared-body">
            <ul class="CoolCare">
              <li>Best price & Best service.</li>
              <li>Regular follow ups..</li>
              <li>Experience technical team does the work</li>
              <li> Best post-sale support</li>
              <li> Our own technicians will do installation/service.</li>
              <li> Technicians availability from 10 AM – 10 PM. </li>
              <li> 7 days working. </li>
              <li> Highly Trained Technicians.</li>
              <li> Custom and Affordable AMC Plans. </li>
              <li> Latest technical machines to repair appliances.</li>
              <li> Personal interaction for customer satisfaction.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--brand slider start-->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="text-center mt-5 mb-5 before position-relative" style=" color: #01316b;">Our customer</h3>
        <div class="owl-carousel" id="brand-slider">
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/10-185x88.png')}}"
              alt="Image 1" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/12-185x88.png')}}"
              alt="Image 2" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/14-185x88.png')}}"
              alt="Image 3" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/16-185x88.png')}}"
              alt="Image 4" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/3-185x88.png')}}"
              alt="Image 5" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/5-185x88.png')}}"
              alt="Image 6" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/7-185x88.png')}}"
              alt="Image 7" class="w-75"></div>
          <div class="item mt-3"><img src="{{url('public/assets/frontend/images/brand img/9-185x88.png')}}"
              alt="Image 8" class="w-75"></div>
          <!-- Add more items as needed -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection