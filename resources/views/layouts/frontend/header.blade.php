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

    <!-- Head title -->
    <title>Home Appliances On Rent In Gurgaon- Appliance Rental Services</title>


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
                            <a href="#"><i class="fa-solid fa-magnifying-glass px-2" style="color: #676767;"></i></a>
                            <a href="#"><i class="fa-regular fa-heart px-2" style="color: #676767;"></i></a>
                            <a href="./cart.php" class="d-flex align-items-center">
                                <i class="fa-solid fa-cart-shopping px-2" style="color: #676767;"></i><span
                                    class="cart-count" id="cartItemCount">0</span></a>
                            <li class="dropdown d-inline" id="dropdownUser1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-regular fa-user px-2" style="color: #676767;"></i>
                            </li>
                            <ul class="dropdown-menu dropdown-menu-end login-drop" id=""
                                aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item fw-bold" href="{{route('frontend.user.dashboar.view')}}"
                                        style=" color: #01316b;">Dashboard</a></li>
                                <li><a class="dropdown-item fw-bold" href="{{route('login')}}"
                                        style=" color: #01316b;">Login</a></li>
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
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Laptop
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./laptop-on-rent-gurgaon.php">Laptop on
                                                Rent</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Heater
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Laptop on Rent</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        AC on Rent
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Laptop on Rent</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">washing Machine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">Refrigerator</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">Microwave</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">LED TV</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">Inverter Battery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="#">R.O</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Furnitures</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
        </nav>

        <!-- secound-Header end -->
    </header>