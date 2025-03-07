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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/frontend/font/MarlinGeo-ExtraBold.ttf')}}">
    <!-- <meta name="base-url" content="http://localhost/ccareservices"> -->
    <!-- <meta name="base-url" content="https://coolcare.toponsearch.in">  -->
    <meta name="base-url" content="http://192.168.1.12/ccareservices">
    
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <meta name="description" content="Cool Care Services offers Home appliances on Rent in Gurgaon with affordable Rental AMC Services. Quote Now for Electronics items for rental!" />
</head>
<body>
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
        
    <header id="section1">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0" >
                <div class="container-fluid">
                    <!--company logo start -->
                    <div class="logo">
                       <a href="/"><img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" ></a>
                    </div>  
                    <!--company logo end -->

                <div class="d-flex gap-3">
                    <span class="navbar-toggler toggleMenubar"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                      <i class="ri-menu-3-line"></i>
                    </span>

                    <!---menubar section start -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                        <!---clise button & logo in mobile start-->
                        <div class="offcanvas-header">
                            <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> -->
                            <div class="logo" style="width:100px">
                                 <a href="/"><img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" style="" ></a>
                            </div>  
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                         <!---clise button & logo in mobile end-->

                        <!---menubar body start-->
                        <div class="offcanvas-body">
                            <ul class="navbar-nav dropMenu justify-content-end flex-grow-1 pe-3" id="header-ul">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/">Home</a>
                                    </li> 
                                    
                                        @foreach($main_categories as $main) 
                                        <li class="nav-item dropdown">
                                        <a class="nav-link {{count($main->subCategory) > 0 ? 'dropdown-toggle' : ''}}" href="{{route('frontend.product.product_list', [Str::slug($main->slug)])}}" role="button" aria-expanded="false">
                                            {{$main->name}}
                                        </a>
                                        @if(count($main->subCategory) > 0)
                                            <ul class="dropdown-menu">
                                                @foreach($main->subCategory as $sub)
                                                <li><a class="dropdown-item" href="{{route('frontend.product.product_list', [Str::slug($main->slug), Str::slug($sub->slug)])}}">{{$sub->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        </li>
                                    @endforeach
                            </ul>
                        </div>
                        <!---menubar body end-->

                    </div>
                    <!---menubar section end -->

                    <!--- add cart & user menubar start-->
                    <div class="top-icon d-flex justify-content-end align-items-center">

                        <a href="{{route('frontend.show.cart')}}" class="d-flex align-items-center" style="text-decoration:none">
                            <i class="fa-solid fa-cart-shopping px-2 fontsizeicon" style="color: #676767;" style="cursor: pointer;"></i>
                            <span class="cart-count" id="cartItemCount">0</span>
                        </a>
                        <li class="dropdown header_user fontsizeicon" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            @guest
                            <i class="fa-regular fa-user px-2 " style="color: #676767;align-self: center;"></i>
                            @else
                            <i class="fa-regular fa-user px-2" style="color: #676767;align-self: center;"></i>
                            @endguest
                        </li>
                        <ul class="dropdown-menu dropdown-menu-end login-drop" id="" aria-labelledby="dropdownUser1">

                            @guest
                            <li>
                                <a class="dropdown-item fw-bold" href="{{route('login')}}" style=" color: #01316b;">Login</a>
                            </li>
                            @else

                            @if(Auth::user()->user_type == 1)
                            <li>
                                <a class="dropdown-item fw-bold" href="{{route('backend.admin.dashboard.view')}}" style=" color: #01316b;" target="_blank">Admin Dashboard</a>
                            </li>
                            
                            @endif
                            <li>
                                <a class="dropdown-item fw-bold" href="{{route('frontend.user.dashboar.view')}}" style=" color: #01316b;">Dashboard</a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item fw-bold" href="{{route('frontend.user.manage_profile.view')}}" style=" color: #01316b;">Profile</a>
                            </li>

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
                    <!--- add cart & user menubar end-->

                 </div>

                </div>
            </nav>
       </div>
    </header>

    <!-- secound-Header -->
<!-- <header class="header" id="section1">
    <div class="container">
        <div class="row rowposition" >

            <div class="col-lg-2 col-6" style="align-self: center;">
                <div class="logo">
                    <a href="/"><img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" ></a>
                </div>  
            </div>

            <div class="col-lg-2 col-4 d-flex justify-content-end align-items-center positionCart">
                <div class="top-icon d-flex justify-content-end align-items-center" > 
                   
                    <a href="{{route('frontend.show.cart')}}" class="d-flex align-items-center" style="text-decoration:none">
                        <i class="fa-solid fa-cart-shopping px-2" style="color: #676767;" style="cursor: pointer;"></i><span
                            class="cart-count" id="cartItemCount">0</span></a>
                    <li class="dropdown header_user" id="dropdownUser1" data-bs-toggle="dropdown"
                        aria-expanded="false" style="cursor: pointer;">
                        @guest
                        <i class="fa-regular fa-user px-2 " style="color: #676767;align-self: center;"></i>
                        @else
                        <i class="fa-regular fa-user px-2" style="color: #676767;align-self: center;"></i>
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
                        <li><a class="dropdown-item fw-bold" href="{{route('frontend.user.manage_profile.view')}}"
                                style=" color: #01316b;">Profile</a></li>
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

            <div class="col-lg-8 col-2 text-end menubarBtn" id="media-logo">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                        <div class="row">
                            <span class="navbar-toggler toggleBTN"  data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation" style="cursor:pointer">
                                <i class="ri-menu-2-line"></i>
                            </span>
                            
                            <div class="col-m-12">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav dropMenu" id="header-ul">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="/">Home</a>
                                        </li> 
                                        @foreach($main_categories as $main) 
                                        <li class="nav-item dropdown">
                                            <a class="nav-link {{count($main->subCategory) > 0 ? 'dropdown-toggle' : ''}}" href="{{route('frontend.product.product_list', [Str::slug($main->slug)])}}" role="button" aria-expanded="false">
                                                {{$main->name}}
                                            </a>
                                            @if(count($main->subCategory) > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach($main->subCategory as $sub)
                                                    <li><a class="dropdown-item" href="{{route('frontend.product.product_list', [Str::slug($main->slug), Str::slug($sub->slug)])}}">{{$sub->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                </nav>
            </div> 

        </div>
    </div>
        
</header> -->