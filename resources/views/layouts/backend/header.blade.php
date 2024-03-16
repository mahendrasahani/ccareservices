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
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i
                                                        class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
            
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{url('public/assets/backend/images/user/1.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="registration.html"><i class="icon-user"></i><span>Edit Profile</span></a></li>
                                        <hr class="my-2">
                                        <li><a href="http://localhost/ccareservices/"><i class="icon-user" target="_blank"></i><span>Go To Website</span></a></li>
                                        <hr class="my-2">
                                        <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
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
                        <img src="{{url('public/assets/backend/images/coolcarelogo-1.jpg')}}" alt="">
                    </span>
                </a>
            </div>
            <hr>
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">

                    <li>
                        <a href="index.html">
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
                            <li><a href="reviews.html">Reviews</a></li>
                            <li><a href="bulk-import.html">Bulk Import</a></li>
                            <li><a href="product_sheet/products.xlsx" download>Bulk Export</a></li>
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
                            <li><a href="orders.html">Orders</a></li> 
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
                            <img src="{{url('public/assets/backend/images/png.icon/payment-method.png')}}" alt="">
                            <p class="sidebar-option">Stock</p>
                        </span>
                        </a>
                    </li>
                    <li><a href="customers.html">
                        <span>
                            <i class="fa fa-users"></i>
                            <p class="sidebar-option">Customers</p>
                        </span>
                        </a>
                    </li>

                    <li><a href="payment-method.html">
                        <span>
                            <img src="{{url('public/assets/backend/images/png.icon/payment-method.png')}}" alt="">
                            <p class="sidebar-option">Payment Methods</p>
                        </span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span>
                                <img src="{{url('public/assets/backend/images/png.icon/money-back.png')}}">
                                <p class="sidebar-option">Refund</p>
                                <p class="badge-1 badge-inline badge-danger pull-right text-white mx-3">Addon</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="refund-requests.html">Refund requests</a></li>
                            <li><a href="refund-settings.html">Refund Settings</a></li>

                        </ul>
                    </li>

                    

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/file.png')}}">
                                <p class="sidebar-option">Blog</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="all-blog.html" aria-expanded="false">All Blogs</a></li>
                            <li><a href="blog-category.html" aria-expanded="false">Blog Categories</a></li>
                        </ul>
                    </li>

                        <li class="mega-menu mega-menu-sm">
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text">
                                    <img src="{{url('public/assets/backend/images/png.icon/monitor.png')}}">
                                    <p class="sidebar-option">Website Setup</p>
                                </span>
        
                            </a>
                            <ul aria-expanded="false">
                                    <li><a href="header.html">Header</a></li>
                                    <li><a href="footer.html">Footer</a></li>                                                                                                                                                                                                                                                                                                                                                                                                          
                                    <li><a href="banners.html">Banners</a></li>
                                    <li><a href="website-pages.html">Pages</a></li>
                                    <li><a href="appearance.html">Appearance</a></li>
                             </ul>
                        </li>
                    
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/shipped.png')}}">
                                <p class="sidebar-option">Delivery Boy</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="delivery-boy.html">All Delivery Boy</a></li>
                            <li><a href="create.html">Add Delivery Boy</a></li>
                            <li><a href="configuration.html">Delivery Boy Configurations</a></li>
                            <li><a href="cancel-request-list.html">Cancel Request</a></li>
                            <li><a href="payment-histories.html">Payment Histories</a></li>
                            <li><a href="collection-histories.html">Collections Histories</a></li>
                        </ul>
                    </li>
                    
                    
                    
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <span class="nav-text">
                                <img src="{{url('public/assets/backend/images/png.icon/setting.png')}}">
                                <p class="sidebar-option">Settings</p>
                            </span>

                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('backend.shipping_charge.index')}}">Shipping Charge</a></li>
                            <li><a href="shop-setting.html">Shop Settings</a></li>
                            <li><a href="general-setting.html">General Settings</a></li>
                            <li><a href="otp-settings.html">OTP Settings</a></li>
                            <li><a href="languages.html">Languages</a></li>
                            <li><a href="currency.html">Currency</a></li>
                            <li><a href="smtp-settings.html">SMTP Settings</a></li>
                            <li><a href="#">File System Configuration</a></li>
                            <li><a href="#">Social media Logins</a></li>
                            <li><a href="#">Third Party Settings</a></li>
                            <li class="mega-menu mega-menu-sm">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text">Shipping</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="physical.html">Shipping Countries</a></li>
                                    <li><a href="digital.html">Shipping States</a></li>
                                    <li><a href="digital.html">Shipping Cities</a></li>
                                    <li><a href="digital.html">Shipping Zones</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Tax</a></li>
                        </ul>
                    </li> 
                </ul>
            </div>
        </div>