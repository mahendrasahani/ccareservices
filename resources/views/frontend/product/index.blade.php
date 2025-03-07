@extends('layouts/frontend/main')
@section('main-section')
<style>
   #toggleList li{
    list-style-type: none; 
    font-size:14px !important;
   }

   #toggleList li a{ 
    font-size:14px;
   }
</style>
 
<section id="banner-image"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h2 class=" text-white pb-2 pt-5 text-center">Categories</h2>
                <nav aria-label="breadcrumb" style="margin: 0 auto;">
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">{{$main_category_name}}</li>
                        <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">{{$sub_cat_name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> 
</section> 

<section>
    <div class="container mt-5">
        <div class="row">
            <form action="#" class="d-flex flex-column flex-md-row justify-content-between mb-3 align-items-center">
                <h5 class="mb-3 mb-md-0">Categories</h5>
                 
            </form>
        </div>
    </div>
</section>
 
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="border: 1px solid #E5EAF0">
                    <div class="card-header" style="background:#E5EAF0; color:#01316b">
                        <h6 class="m-0 p-0">More Option</h6>
                    </div>
                    <div class="card-body">  
                        <ul id="toggleList" class="">
                            @foreach($main_categories as $main) 
                                <li class="cotegories_list mb-3"><a href="#" class="text-decoration-none text-dark" >{{$main->name}}</a>
                                @if(count($main->subCategory) > 0)
                                <i class="fa-solid fa-caret-down mx-2"></i> 
                                    <ul class="subList_categries">
                                    @foreach($main->subCategory as $sub)
                                        <li class="mt-2 mb-2"><a href="{{route('frontend.product.product_list', [Str::slug($main->slug), Str::slug($sub->slug)])}}" class="text-decoration-none text-dark">{{$sub->name}}</a> </li> 
                                        @endforeach
                                    </ul>
                                    @endif
                                </li> 
                                @endforeach
                        </ul> 
                    </div>
                </div>
                <!--product filter-->
                <!-- <div class="card mt-5">
                    <div class="card-header">
                        <h6>Filter</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input filter" type="checkbox" value="" id="allCheckbox"
                                data-filter="all">
                            <label class="form-check-label" for="allCheckbox">All</label>
                        </div>
                        @foreach($sub_cat_list as $sub_cat)
                        <div class="form-check">
                            <input class="form-check-input filter" type="checkbox" value="{{$sub_cat->id}}" id="laptopCheckbox"
                                data-filter="{{$sub_cat->name}}">
                            <label class="form-check-label" for="laptopCheckbox">{{$sub_cat->name}}</label>
                        </div>
                        @endforeach
                         
                    </div>
                </div> -->
            </div>
            <div class="col-md-9">
                <div class="row">
                    
                    <input type="hidden" value="{{$page_url}}" id="page_url">

                    @foreach($product_list as $product)
                    <div class="col-md-4 all laptop" class="content" id="{{$product->slug}}">
                        <div class="card h-100 ">
                            <div class="cart_img_wrap mt-2">
                                <a href="{{route('frontend.product.single_product', [$product->slug])}}"><img
                                        src="{{$product->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->product_images[0])}}"></a>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold"><a href="{{route('frontend.product.single_product', [$product->slug])}}" class="text-decoration-none"
                                        style="color: black;">{{$product->product_name}}</a></h6>

                                @if($product->discount_type == 'flat')
                                <p class="fw-bold">₹{{number_format($product->regular_price - $product->discount, 2)}}
                                </p>
                                @elseif($product->discount_type == 'percent')
                                <p class="fw-bold">₹{{number_format($product->regular_price - ($product->regular_price * $product->discount)/100, 2)}}</p>
                                @endif
                              
                                <hr>
                                <a href="{{route('frontend.product.single_product', [$product->slug])}}" class="btn btn-warning animation search-cate">Rent Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                    
                </div>
                <div class="col-md-12" class="my_pagination">
                    {{$product_list->links('pagination::bootstrap-5')}}
                </div>

            </div>
            
            <div class="col-md-12 mt-5 p-tag">
                {!! $sub_cat_row->page_description !!}
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 
<script>
    $(document).ready(function () {
        let page_url = $("#page_url").val();
        $('.filter').change(function () {
            var checkedValues = [];
            $('.filter:checked').each(function () {
                checkedValues.push($(this).val());
            });

            var filter = checkedValues.join(',');
            window.location.href = page_url+'/?filter=' + filter;
        });
    });
</script>

<script>
    $(document).on('click', '#load_more', function ()
    {
        console.log('test tss');
        $('#loader').show();

        // $.ajax({
        //     url: 'your-backend-endpoint',  
        //     type: 'GET',
        //     success: function(data) { 
        //         $('#content').append(data); 
        //         $('#loader').hide();
        //     }
        // });
    });  
</script>

<script>
    // Get all parent list items
    const parentItems = document.querySelectorAll('#toggleList > li');

    // Add click event listener to each parent list item
    parentItems.forEach(item =>
    {
        item.addEventListener('click', function ()
        {
            // Toggle visibility of nested ul
            const nestedUl = this.querySelector('ul');
            if (nestedUl)
            {
                nestedUl.style.display = nestedUl.style.display === 'none' ? 'block' : 'none';
            }
        });
    });

    // Initially hide all nested ul elements
    document.querySelectorAll('#toggleList ul').forEach(ul => ul.style.display = 'none');
</script>


@endsection