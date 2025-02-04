@extends('layouts/backend/main')
@section('main-section')

<style>
    .product_img{
        width: 200px;
        height:200px;
    }
    .product_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card art_card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-auto"> 
                                            <div class="product_img">
                                                <img src="{{$product_detail->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product_detail->product_images[0])}}"
                                                    class="img-fluid">
                                            </div>
                                             
                                        </div>
                                        <div class="col-lg">
                                            <h1 class="h5 fw-700">{{$product_detail->product_name}}</h1>
                                            <div class="d-flex align-items-center mb-3">
                                                <span class="rating">
                                                    <i class="las la-star active"></i><i class="las la-star active"></i><i
                                                        class="las la-star active"></i><i class="las la-star active"></i><i
                                                        class="las la-star active"></i>
                                                </span>
                                             
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <div class="border border-dotted rounded py-2 px-3 mr-3 ml-0">
                                                    <div class="h3 mb-0 fw-700">{{$review_count ?? '0'}}</div>
                                                    <div class="opacity-60 fs-12">Reviews</div>
                                                </div>
                                                <div class="border border-dotted rounded py-2 px-3 mr-3 ml-0">
                                                    <div class="h3 mb-0 fw-700">0</div>
                                                    <div class="opacity-60 fs-12">In wishlist</div>
                                                </div>
                                                <div class="border border-dotted rounded py-2 px-3 mr-3 ml-0">
                                                    <div class="h3 mb-0 fw-700">{{$cart_count ?? '0'}}</div>
                                                    <div class="opacity-60 fs-12">In cart</div>
                                                </div>
                                                <div class="border border-dotted rounded py-2 px-3 mr-3 ml-0">
                                                    <div class="h3 mb-0 fw-700">{{$time_sold ?? '0'}}</div>
                                                    <div class="opacity-60 fs-12">Times Rent</div>
                                                </div>
                                                <!-- <div class="border border-dotted rounded py-2 px-3 mr-3 ml-0">
                                                    <div class="h3 mb-0 fw-700">₹
                                                    @if($product_detail->discount_type == 'flat')
                                                    {{number_format($product_detail->regular_price - $product_detail->discount, 2)}}
                                                    @else
                                                    {{number_format(($product_detail->regular_price *  $product_detail->discount) / 100, 2)}}

                                                    @endif 
                                              
                                                </div>
                                                    <div class="opacity-60 fs-12">Amount sold</div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card art_card">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Status:</span>
                                            @if($product_detail->product_status == 1)
                                        <span class="badge badge-inline badge-success text-white">Published</span>
                                        @else
                                        <span class="badge badge-inline badge-success text-white">Draft</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Brand:</span>
                                        <div class="brand-img-logo"> 
                                            <img src="{{url($product_detail->getBrand->logo)}}" alt="Brand" > 
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Category:</span>
                                        @if(count($product_detail->main_category) > 0)
                                        @php 
                                            $main_cat_list = App\Models\Backend\MainCategory::whereIn('id', $product_detail->main_category)->get(); 
                                        @endphp
                                        <span class="text-right"> 
                                @foreach($main_cat_list as $main_cat) 
                                <span class="badge badge-inline bg-dark">{{$main_cat->name}}</span> 

                                @endforeach
                           @endif
                                        </span>
                                    </div>
                                     
                                     
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Minimum Purchase Qty:</span>
                                        <span>{{$product_detail->min_purchase_qty}}</span>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Maximum Purchase Qty:</span>
                                        <span>{{$product_detail->max_purchase_qty}}</span>
                                    </div>
                                </div>
                            </div>
                            
                             
                            
                        </div>
                        <div class="col-md-8">
                             
                            
                            <div class="card art_card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Gallery</h5>
                                </div>
                                <div class="card-body d-flex justify-content-around">
                                @if($product_detail->product_images !=  '')
                                @foreach($product_detail->product_images as $image)
                                <img src="{{url('public/'.$image)}}" class="img-fluid w-25 m-1">  
                                @endforeach
                                @else
                                <p>No Images Available</p>
                                @endif
                                </div>
                            </div>
                             
                            <div class="card art_card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Product Description</h5>
                                </div>
                                <div class="card-body">
                                   {!! $product_detail->product_description !!}
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container end-->
        </div>

@endsection