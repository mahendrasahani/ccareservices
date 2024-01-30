@extends('layouts/frontend/main')
@section('main-section')
<style>
    body {
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
    }
</style>
<section id="banner-image">
    <!-- breadcrumb strat -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h2 class=" text-white pb-2 pt-5 text-center">HP Laptop Core I5</h2>
                <nav aria-label="breadcrumb" style="margin: 0 auto;">
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="laptop-on-rent-gurgaon.html" class="text-white">Laptop</a>
                        </li>
                        <li class="breadcrumb-item active pt-1" aria-current="page"
                            style="color: #01b7e0; font-size: 14px;">HP Laptop Core I5</li>
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
                <!-- <div class="img_producto_container" data-scale="1.6">
                    <img class="dslc-lightbox-image img_producto" href="" target="_self"
                        style=" background-image:url('{{url('public/assets/frontend/images/single-product/product-single.jpg')}}"></img>
                </div> -->

                <div class="wrapper">
                    <section class="mainImage"> </section>
                    <section class="thumbnail"> </section>
                </div>

            </div>
            <div class="col-md-6">
                <div class="product-right-content">
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
                        <h1 class="fs-3">HP Laptop core i5</h1>
                        <p>Product Code: HP Core i5</p>
                        <div class="available d-flex">
                            <p class="mx-2">Availability:</p>
                            <p class="text-success"> In Stock</p>
                            <!-- <p class="text-danger"> Out of Stock</p> -->
                        </div>
                    </div>
                    <div class="prpduct-price">
                        <h4>Rs 1000 / Month</h4>
                    </div>
                    <form action="#">
                        <div class="select-box">
                            <label for="select-option" class="month-select">Select Month:</label> <br>
                            <select name="select-option" id="select-option" aria-placeholder="---Please Select---">
                                <option value="1">---Please Select---</option>
                                <option value="2">1</option>
                                <option value="3">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                                <option value="3">5</option>
                            </select>
                            <br>
                            <label for="select-option" class="month-select mt-2">Delivery Date:</label> <br>
                            <input type="date" id="selectDate" name="selectDate">
                        </div>
                        <div class="product-quantity d-flex mt-3">
                            <div class="mx-2 d-flex">
                                <p class="mx-2 m-auto"> Qty</p>
                                <input type="number" id="quantity" value="0" min="0"
                                    style="width: 10%;padding-left: 10px;height: 30px;">
                                <button type="button" class="btn btn-warning animation  mx-2 " onclick="addToCart()">Add
                                    to Cart</button>
                                <button type="button" class="btn btn-warning animation ">Add to Wishlist</button>
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
    // JavaScript function to handle "Add to Cart" button click
    function addToCart()
    {
        event.preventDefault();
        // Get the current item count from the span element
        var currentItemCount = parseInt(document.getElementById('cartItemCount').innerText);


        // Get the quantity input value
        var quantity = parseInt(document.getElementById('quantity').value);

        // Increment the item count based on the quantity
        var newItemCount = currentItemCount + quantity;

        // Update the span element with the new item count
        document.getElementById('cartItemCount').innerText = newItemCount;
    }
</script>

<script>
    // document selector
    const thumbnailWrapper = document.querySelector(".thumbnail");
    const thumbnailBox = document.querySelectorAll(".thumbnailBox");
    const mainImage = document.querySelector(".mainImage");

    // list of images
    const imageList = [
        "https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bGFwdG9wJTIwY29tcHV0ZXJ8ZW58MHx8MHx8fDA%3D",
        "https://media.sketchfab.com/models/52d7da884412402eba0d6ce143969b90/thumbnails/38b86078358748dfb2b7ad9e98d0e89d/2642a999cbfa4076b78dff973dea08bf.jpeg",
        "https://media.sketchfab.com/models/269e7e4a84fe429faa7bfe4069792047/thumbnails/1551456ef80d43a285f47fb3a8428f77/0c831503e2c44ea9a3f67785e858f798.jpeg"
    ];

    // Set the first image to be shown initially
    mainImage.innerHTML = `<img src="${imageList[0]}" alt="">`;
    mainImage.addEventListener("mousemove", (e) =>
    {
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
    imageList.forEach((image, index) =>
    {
        const isActive = index === 0 ? "active" : "";
        const child = `<div class="thumbnailBox ${isActive}">
            <img src="${image}" alt="">
        </div>`;
        const div = document.createElement("div");
        div.innerHTML = child;
        thumbnailWrapper.appendChild(div);
    });

    thumbnailWrapper.querySelectorAll(".thumbnailBox").forEach((thumbnail) =>
    {
        thumbnail.addEventListener("click", (e) =>
        {
            const activeThumbnail = document.querySelector(".thumbnailBox.active");
            if (activeThumbnail)
            {
                activeThumbnail.classList.remove("active");
            }
            thumbnail.classList.add("active");
            imageSrc = thumbnail.querySelector("img").getAttribute("src");
            mainImage.innerHTML = `<img src="${imageSrc}" alt="">`;
        });
    }); 
</script>

@endsection