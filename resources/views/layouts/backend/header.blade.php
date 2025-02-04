<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Home Appliances On Rent In Gurgaon- Appliance Rental Services</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('public/assets/backend/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{url('public/assets/backend/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{url('public/assets/backend/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{url('public/assets/backend/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{url('public/assets/backend/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
</head>
    
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <!-- <div class="nav-header" id="navToggle-header">
            

        </div> -->
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger" id="icon-menuclick">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="top_header_ico">
                        <button onclick="clearCacheAndShowPopup()" class="btn btn- mt-4 button" style="color:#76838f;"><i class="fa-regular fa-hard-drive" style="color: #aeaeae;"></i> &nbspClear Cache</button>
                        <div id="bottomLeftPopup" class="popup">
                            <span onclick="closeBottomLeftPopup()" class="close mt-2 mx-2" >&times;</span>
                            <p class="pt-2">Cache cleared successfully!</p>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">   
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{url('public/assets/backend/images/user/1.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="{{route('backend.admin.edit_admin_profile')}}"><i class="icon-user"></i><span>Edit Profile</span></a></li>
                                        <hr class="my-2">
                                        <li><a href="http://localhost/ccareservices/"><i class="icon-user" target="_blank"></i><span>Go To Website</span></a></li>
                                        <hr class="my-2">
                                        <li>  
                                        <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2  dropdown-item fw-bold"
                                            style=" font-size: 13px;color: #01316b;"><i class="icon-key"></i> Logout</button>
                                        </form> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar" id="nmk-sidebar">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="{{url('public/assets/backend/images/logo.png')}}" alt=""> </b>
                     
                    <span class="brand-title">
                        <a href="{{route('backend.admin.dashboard.view')}}">
                    <img src="{{url('public/assets/backend/images/coolcarelogo-1.jpg')}}" alt=""></a>
                        
                    </span>
                </a>
            </div>
            <hr>
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu"> 
                    <li>
                        <a href="{{route('backend.admin.dashboard.view')}}">
                            <span>
                                <img src="{{url('public/assets/backend/images/png.icon/dashboard.png')}}" class="">
                                <p class="sidebar-option">Dashboard</p>
                            </span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/box.png')}}">
                                <p class="sidebar-option">Product</p>
                            </span>
                        </a>
                        <ul aria-expanded="false"> 
                            <li><a href="{{route('backend.admin.product.index')}}">Products</a></li> 
                            <li><a href="{{route('backend.brand.index')}}">Brand</a></li>
                            <li><a href="{{route('backend.attribute.index')}}">Attributes</a></li>
                            <li><a href="{{route('backend.review.index')}}">Reviews</a></li>
                      
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                 <img src="{{url('public/assets/backend/images/png.icon/category.png')}}" alt="">   
                                <p class="sidebar-option">Category</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('backend.main_category.index')}}">Main Category</a></li>
                            <li><a href="{{route('backend.sub_category.index')}}">Sub Category</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/package.png')}}" class="">
                                <p class="sidebar-option">Orders</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('backend.order.index')}}">Orders</a></li> 
                        </ul>
                    </li>
                    <li><a href="{{route('backend.vendor.index')}}">
                        <span>
                            <img src="{{url('public/assets/backend/images/png.icon/seller.png')}}" alt="">
                            <p class="sidebar-option">Vendors</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="{{route('backend.stock.index')}}">
                        <span>
                            <i class="fa fa-archive"></i>
                            <p class="sidebar-option">Stock</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="{{route('backend.return.index')}}">
                        <span>
                             <i class="fa fa-undo"></i> 
                            <p class="sidebar-option">Return</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="{{route('backend.customer.index')}}">
                        <span>
                            <i class="fa fa-users"></i>
                            <p class="sidebar-option">Customers</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="{{route('backend.shipping_charge.index')}}">
                        <span>
                            <i class="fa fa-truck"></i>

                            <p class="sidebar-option">Shipping Charge</p>
                        </span>
                        </a>
                    </li>

                    <li><a href="{{route('backend.payment_method.index')}}">
                        <span>
                            <i class="fa fa-credit-card"></i>
                            <p class="sidebar-option">Payment Methods</p>
                        </span>
                        </a>
                    </li> 
                    
                    <li><a href="{{route('backend.tax')}}">
                        <span>
                            <i class="fa fa-credit-card"></i>
                            <p class="sidebar-option">Tax Rates</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="{{route('backend.recent_activity')}}">
                        <span>
                            <i class="fa fa-credit-card"></i>
                            <p class="sidebar-option">Recent Activity</p>
                        </span>
                        </a>
                    </li>

                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/shipped.png')}}">
                                <p class="sidebar-option">Delivery Boy</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('backend.delivery_boy.index')}}">All Delivery Boy</a></li>
                            <li><a href="{{route('backend.delivery_boy.create')}}">Add Delivery Boy</a></li>
                     
                        </ul>
                    </li>
                      
                </ul>
            </div>
        </div>