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
                        <li class="breadcrumb-item active pt-1" aria-current="page"
                            style="color: #01b7e0; font-size: 14px;">Categories</li>
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
                <h4 class="mb-3 mb-md-0">Categories</h4>
                <div class="d-flex align-items-center">
                    <label for="sortSelect" class="label-width me-2">Sort by:</label>
                    <select class="form-select" id="sortSelect" aria-label="">
                        <option selected="">Default</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="ms-md-3">
                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                            placeholder="Type & Enter">
                    </div>
                    <div class="ms-md-3"> 
                        <input class="form-control" type="text" style="border-radius: 0;" placeholder="Search">
                    </div>
                    <a href="" class="" style="font-size: 10px;"><button type="button"
                            class="btn btn-warning animation search-cate">Search</button></a>
                </div>
            </form>
        </div>
    </div>
</section>
 
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                        <h6>More Option</h6>
                    </div>
                    <div class="card-body"> 
                        <ul id="toggleList">
                            <li ><a href="#" class="text-decoration-none text-dark" >Laptop</a>
                            <i class="fa-solid fa-caret-down mx-2"></i>
                                <ul>
                                    <li class="mt-2 mb-2"><a href="#" class="text-decoration-none text-dark">Window AC on Rent</a> </li> 
                                </ul>
                            </li>
                            <li><a href="#" class="text-decoration-none text-dark"  >Heater</a>
                            <i class="fa-solid fa-caret-down mx-2"></i>
                                <ul>
                                    <li class="mt-2 mb-2"><a href="#" class="text-decoration-none text-dark">Heater On Rent</a> 
                                </ul>
                            </li>
                            <li><a href="#" class="text-decoration-none text-dark" >Laptop On rent</a>
                            <i class="fa-solid fa-caret-down mx-2"></i>
                                <ul>
                                    <li class="mt-2 mb-2"><a href="#" class="text-decoration-none text-dark" >Window AC on Rent</a></li>
                                    <li class="mt-2 mb-2"><a href="#" class="text-decoration-none text-dark" >Split AC on Rent</a> </li>
                                </ul>
                            </li>
                        </ul> 
                    </div>
                </div>
                <!--product filter-->
                <div class="card mt-5">
                    <div class="card-header">
                        <h6>Filter</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input filter" type="checkbox" value="" id="allCheckbox"
                                data-filter="all">
                            <label class="form-check-label" for="allCheckbox">All</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filter" type="checkbox" value="" id="laptopCheckbox"
                                data-filter="laptop">
                            <label class="form-check-label" for="laptopCheckbox">Laptop</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filter" type="checkbox" value="" id="oldLaptopCheckbox"
                                data-filter="oldLaptop">
                            <label class="form-check-label" for="oldLaptopCheckbox">Old Laptop</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    @foreach($product_list as $product)
                    <div class="col-md-3 all laptop" class="content" id="all">
                        <div class="card item ">
                            <div class="card-header">
                                <a href="single-product.html"><img
                                        src="{{$product->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->product_images[0])}}"
                                        class="w-100"></a>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold"><a href="single-product.html" class="text-decoration-none"
                                        style="color: black;">{{$product->product_name}}</a></h6>

                                @if($product->discount_type == 'flat')
                                <p class="fw-bold">₹{{number_format($product->regular_price - $product->discount, 2)}}
                                </p>
                                @elseif($product->discount_type == 'percent')
                                <p class="fw-bold">₹{{number_format($product->regular_price - ($product->regular_price * $product->discount)/100, 2)}}</p>
                                @endif 
                                <p class="" style="font-size: 11px; color: gray;">{!! Str::limit($product->product_description, 40) !!}</p>
                                <hr> 
                                <a href="{{route('frontend.product.single_product', [$main_category, $sub_category, $product->slug])}}" class="animate-btx btn btn-warning animation">View More</a>
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
                <p>Although renting a laptop may be unfamiliar to us, successful businesses are no strangers to making
                    this wise option in the first place. With the advent of work-from-home culture and online schooling
                    during the epidemic, it is undeniable that firms are struggling from the surge in demand for laptops
                    and other portable devices. Everyone, of course, wants to invest in cutting-edge technology to
                    attain peak performance, but what should you do if your budget is a little restricted? It's possible
                    that renting a laptop for your team or simply renting IT equipment, in general, will solve your
                    problem. For your convenience, we've compiled a summary of some of the benefits of this popular
                    option to assist you in making an informed decision.</p>

                <p>Purchasing laptops or any other IT equipment is not a simple decision - you must first establish
                    budgets, then examine the different brands available on the market, and lastly, determine what
                    connects with your needs and what is currently trendy! After all, purchasing information technology
                    gear is a significant financial commitment in most circumstances. A laptop rental is an easy answer
                    in this situation, as it provides greater flexibility and room for error. If you plan on renting a
                    laptop from Cool Care Services, you should be aware of the following:</p>

                <ul class="list-inline">
                    <li>- There are no up-front fees associated with your rent.</li>
                    <li>- Get the same high-quality results at a low cost with our simple, cheap pricing!</li>
                    <li>- Renting a laptop eliminates the need for ongoing maintenance.</li>
                    <li>- Preventing technological obsolescence is essential.</li>
                    <li>- You can customize it.</li>
                </ul>
                <p>We are well-versed in the subject of paradigm shifts. It is nearly hard to perform any work without
                    using a laptop computer. It has evolved into a social and professional prerequisite that will assist
                    you in remaining on par with the rest of the globe in your endeavors. Renting a laptop is a pleasant
                    alternative to purchasing a computer and avoiding dealing with out-of-date equipment. Why not start
                    with the finest to get you started on your laptop rental adventure? Cool Care Services may provide
                    you with a rented laptop.</p>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 

<script>
    document.addEventListener('DOMContentLoaded', function ()
    {
        const checkboxes = document.querySelectorAll('.filter');
        const items = document.querySelectorAll('.item');

        checkboxes.forEach(function (checkbox)
        {
            checkbox.addEventListener('change', function ()
            {
                const filterValue = this.getAttribute('data-filter');

                items.forEach(function (item)
                {
                    if (filterValue === 'all' || item.classList.contains(filterValue))
                    {
                        item.style.display = this.checked ? 'block' : 'none';
                    } else
                    {
                        item.style.display = 'none';
                    }
                }.bind(this));
            });
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