@extends('layouts/frontend/main')
@section('main-section')
<style>
    .wrapper {
        min-width: 400px;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;

        .thumbnail {
            .thumbnailBox {
                border-radius: 4px;
                overflow: hidden;
                max-height: 100px;
                min-height: 100px;
                min-width: 100px;
                max-width: 100px;
                margin-bottom: 15px;
                cursor: pointer;
                border: 2px solid transparent;
                transition: all 0.5s;

                &.active {
                    opacity: 1;
                    border: 2px solid #202020;
                }

                img {
                    aspect-ratio: 1/1;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
        }

        .mainImage {
            overflow: hidden;
            min-width: 500px;
            max-width: 500px;
            border-radius: 10px;
            cursor: crosshair;

            img {
                width: 100%;
                height: 100%;
                aspect-ratio: 1/1;
                object-fit: cover;
            }
        }
    }
</style>

<section id="banner-image">
    <!-- breadcrumb strat -->
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
    <!-- breadcrumb end -->
</section>

<section>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6"> 

                <div class="wrapper">
                    <section class="mainImage"> 
                    <img src="{{url('public/'.$product_detail->product_images[0])}}" alt="">
                    </section>
                    <section class="thumbnail">  
                        <div> 
                            @foreach($product_detail->product_images as $key => $images)
                            <div class="thumbnailBox {{$key == 0 ? "active":""}}">
                            <img src="{{url('public/'.$images)}}" alt="">
                        </div>
                            @endforeach
                    </div>
                    </section>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-right-content">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="reviews d-flex">
                                <div class="star mx-2">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="review-counting d-flex mx-2">
                                    <p class="">0 Reviews |</p>
                                    <a href="#description" style="text-decoration:none;">
                                        <p class="" style="color:#01316b"> &nbsp Write a Review</p>
                                    </a>
                                </div>
                            </div>
                            <div class="product-details">
                                <h1 class="fs-3">{{$product_detail->product_name}}</h1>
                                <!-- <p>Product Code: HP Core i5</p> -->
                                <div class="available d-flex">
                                    <p class="mx-2">Availability:</p>
                                    @if($product_detail->stock_status == 0)
                                    <p class="text-danger"> Out of Stock</p>
                                    @else 
                                    <p class="text-success"> In Stock</p>
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
                                    <label for="select-option" class="month-select">Select Month:</label> <br>
                                    <select name="select-option" id="select-option"
                                        aria-placeholder="---Please Select---">
                                        <option value="">---Please Select---</option>
                                        <option value="1">1 Month</option>
                                        <option value="2">2 Months</option>
                                        <option value="3">3 Months</option>
                                        <option value="4">4 Months</option>
                                        <option value="5">5 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="7">7 Months</option>
                                        <option value="8">8 Months</option>
                                        <option value="9">9 Months</option>
                                        <option value="10">10 Months</option>
                                        <option value="11">11 Months</option>
                                        <option value="12">12 Months</option>
                                    </select>
                                    <br>
                                    <label for="select-option" class="month-select mt-2">Delivery Date:</label> <br>
                                    <input type="date" id="delivery_date" name="delivery_date">
                                </div>
                                <div class="product-quantity d-flex mt-3">
                                    <div class="mx-2 d-flex">
                                        <p class="mx-2 m-auto"> Qty</p>
                                        <input type="number" id="quantity" value="0" min="0"
                                            style="width: 14%; height: 30px;">
                                        <button type="button" class="btn btn-warning animation  mx-2 "
                                            onclick="addToCart()">Add
                                            to Cart</button>
                                        <button type="button" class="btn btn-warning animation ">Add to
                                            Wishlist</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Capacity</h6>
                                <div class="cap-btns">
                                    <input type="radio" id="category1" name="category" value="160">
                                    <label for="category1">160-180 l</label>
                                    <input type="radio" id="category2" name="category" value="180">
                                    <label for="category2">180-200 l</label>
                                    <input type="radio" id="category3" name="category" value="200">
                                    <label for="category3">200-220 l</label>
                                </div>
                                <div class="calculator card">
                                    <label>Choose Tenure</label>
                                    <input type="range" min="1" max="12" value="1" id="slider">
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
                                    <p>Price: <span id="price">$50</span></p>
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

                <p>SECURITY...(CASH NIL) PDC (Post Dated Cheque) 31December 2024 Rs.7000. It will be returned back
                    at the time of Pickup.

                    Stabilizer charge extra 700 Rs if required.

                    Transport charge extra 300 Rs.

                    Submeter charge...500 if Required.

                    Power Requirements:AC 230 V, 50 Hz. Pre installed plug point of 15 Amp should be available near
                    ac.</p>
            </div>
            <div class="tab-pane fade" id="myreview">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Leave a review</h6>
                        <form id="reviewForm">
                            <label for="review">Your Review:</label><br>
                            <textarea id="review" name="review" placeholder="Write your review here..."
                                cols="50"></textarea><br>
                            <button type="button" class="btn btn-warning animation  mx-2">Submit Review</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h6>Show some reviws here</h6>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script> 
var datePicker = document.getElementById("delivery_date"); 
function setMinMaxAttributes() {
    var today = new Date().toISOString().split("T")[0];
    datePicker.setAttribute("min", today);
} 
datePicker.addEventListener("input", function() {
    if (isDateDisabled(this.value)) {
        this.value = "";
        alert("This date is disabled.");
    }
}); 
setMinMaxAttributes();
</script>
<script> 
    function addToCart(){
        event.preventDefault(); 
        var currentItemCount = parseInt(document.getElementById('cartItemCount').innerText);  
        var quantity = parseInt(document.getElementById('quantity').value); 
        var newItemCount = currentItemCount + quantity; 
        document.getElementById('cartItemCount').innerText = newItemCount;
    }
</script>

<script> 
    const thumbnailWrapper = document.querySelector(".thumbnail"); 
    const mainImage = document.querySelector(".mainImage"); 
    mainImage.addEventListener("mousemove", (e) =>{
        const containerWidth = mainImage.offsetWidth;
        const containerHeight = mainImage.offsetHeight; 
        const image = mainImage.querySelector("img");
        const imageWidth = image.offsetWidth;
        const imageHeight = image.offsetHeight; 
        const x = e.pageX - mainImage.offsetLeft;
        const y = e.pageY - mainImage.offsetTop; 
        const translateX = (containerWidth / 2 - x) * 2;
        const translateY = (containerHeight / 2 - y) * 2; 
        const scale = 3; 
        image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
    });
    mainImage.addEventListener("mouseleave", (e) =>
    {
        const image = mainImage.querySelector("img");
        image.style.transform = "translate(0%, 0%) scale(1)";
    });
   
    thumbnailWrapper.querySelectorAll(".thumbnailBox").forEach((thumbnail) =>{
        thumbnail.addEventListener("click", (e) =>{
            const activeThumbnail = document.querySelector(".thumbnailBox.active");
            if (activeThumbnail){
                activeThumbnail.classList.remove("active");
            }
            thumbnail.classList.add("active");
            imageSrc = thumbnail.querySelector("img").getAttribute("src");
            mainImage.innerHTML = `<img src="${imageSrc}" alt="">`;
        });
    }); 
</script>

<script>
    const slider = document.getElementById("slider");
    const priceDisplay = document.getElementById("price");
    const radioButtons = document.querySelectorAll("input[type='radio'][name='category']");

    function updatePrice(){
        const sliderValue = slider.value;
        const selectedRadio = document.querySelector("input[type='radio'][name='category']:checked");
        const radioValue = selectedRadio ? selectedRadio.value : 0;
        const price = sliderValue * 2 + parseInt(radioValue);
        priceDisplay.textContent = `$${price}`;
    }

    slider.addEventListener("input", updatePrice);
    radioButtons.forEach(radioButton =>{
        radioButton.addEventListener("change", updatePrice);
    }); 
    updatePrice();  
</script>

<script>
    const slider = document.getElementById("slider");
        const priceDisplay = document.getElementById("price");
        const radioButtons = document.querySelectorAll("input[type='radio'][name='category']");

        function updatePrice(){
            const sliderValue = slider.value;
            const selectedRadio = document.querySelector("input[type='radio'][name='category']:checked");
            const radioValue = selectedRadio ? selectedRadio.value : 0;
            const price = sliderValue * 2 + parseInt(radioValue);
            priceDisplay.textContent = `$${price}`;
        }
        slider.addEventListener("input",updatePrice);
        radioButtons.forEach(radioButton=>{
            radioButton.addEventListener("change",updatePrice)
        })
</script>

 

@endsection