<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{url('public/assets/frontend/css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('public/assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/frontend/font/MarlinGeo-ExtraBold.ttf')}}">
    <meta name="base-url" content="http://localhost/ccareservices">
    <!-- Head title -->
    <title>Home Appliances On Rent In Gurgaon- Appliance Rental Services</title>
    

    <style>
         

        .search-field {
            background-color: transparent;
            background-image: url(https://wp-themes.com/wp-content/themes/twentythirteen/images/search-icon.png);
            background-position: 5px center;
            background-repeat: no-repeat;
            background-size: 18px 18px;
            border: none;
            cursor: pointer; 
            margin: 3px 0;
            padding: 0 0 0 34px;
            position: relative;
            -webkit-transition: width 400ms ease, background 400ms ease;
            transition: width 400ms ease, background 400ms ease;
            width: 0px;
            cursor: pointer;
        }

        .search-field:focus { 
            cursor: text;
            outline: 0;
            width: 170px;
            color: #000;
            border: 1px solid #000;
        }

        .search-form .search-submit {
            display: none;
        }
    </style>

    <meta name="description"
        content="Cool Care Services offers Home appliances on Rent in Gurgaon with affordable Rental AMC Services. Quote Now for Electronics items for rental!" />
</head>

<body>

    <!-- Top-Header -->
    <section class="top-header" id="myElement">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <p class="text-end text-white fw-bold pb-0 Offer mb-0 cupan">
                        Exclusive Offer - Additional 20% OFF. Use Code "NEWYEAR"
                    </p>
                </div>
                <div class="col-md-4 text-end" id="closeButton">
                    <i class="fa-solid fa-x" style="color:white; cursor: pointer;"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- Top-Header end -->
    <!-- secound-Header -->
    <header class="header" id="section1">
        <div class="container">
            <div class="row">
                <div class="d-flex">
                    <div class="col-md-6" id="media-logo">
                        <a href=""><img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}"
                                class="w-25"></a>
                    </div>
                    <div class="col-md-6 text-end pt-4">
                        <div class="top-icon d-flex justify-content-end" style="cursor: pointer; padding: 0 44px;"> 
                            <a href="#"> 
                                    <form role="search" method="get" class="search-form" action="">
                                        <label>

                                            <input type="search" class="search-field" placeholder="Search …" value=""
                                                name="s" title="Search for:" />
                                        </label>
                                        <input type="submit" class="search-submit" value="Search" />
                                    </form> 
                            </a>
                            <a href="{{route('frontend.show.cart')}}" class="d-flex align-items-center">
                                <i class="fa-solid fa-cart-shopping px-2" style="color: #676767;"></i><span
                                    class="cart-count" id="cartItemCount">0</span></a>
                            <li class="dropdown d-inline" id="dropdownUser1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @guest
                                <i class="fa-regular fa-user px-2" style="color: #676767;"></i>
                                @else
                                <i class="fa-regular fa-user px-2" style="color: #676767;"></i>{{Auth::user()->name}}
                                @endguest
                            </li>
                            <ul class="dropdown-menu dropdown-menu-end login-drop" id=""
                                aria-labelledby="dropdownUser1">
                                @guest
                                <li><a class="dropdown-item fw-bold" href="{{route('login')}}"
                                        style=" color: #01316b;">Login</a></li>
                                @else
                                @if(Auth::user()->user_type == 1)
                                <li><a class="dropdown-item fw-bold" href="{{route('backend.admin.dashboard.view')}}" style=" color: #01316b;" target="_blank">Admin Dashboard</a></li>
                                <li>
                                @endif
                                <li><a class="dropdown-item fw-bold" href="{{route('frontend.user.dashboar.view')}}"
                                        style=" color: #01316b;">Dashboard</a></li>
                                <li> 
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2  dropdown-item fw-bold"
                                            style=" font-size: 13px;color: #01316b;"> Logout</button>
                                    </form>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="row">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="col-md-12">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav" id="header-ul">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="index.html">Home</a>
                                </li>

                                @foreach($main_categories as $main)



                                <li class="nav-item dropdown">
                                    <a class="nav-link {{count($main->subCategory) > 0 ? 'dropdown-toggle' : ''}}" href="{{route('frontend.product.product_list', [Str::slug($main->name)])}}" role="button" aria-expanded="false">
                                        {{$main->name}}
                                    </a>
                                    @if(count($main->subCategory) > 0)
                                        <ul class="dropdown-menu">
                                            @foreach($main->subCategory as $sub)
                                            <li><a class="dropdown-item" href="{{route('frontend.product.product_list', [Str::slug($main->name), Str::slug($sub->name)])}}">{{$sub->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('testing_flush_cart')}}">Flush Cart</a>
                                </li>
 
                            </ul>
                        </div>
                    </div>
                </div>
        </nav>

        <!-- secound-Header end -->
    </header>