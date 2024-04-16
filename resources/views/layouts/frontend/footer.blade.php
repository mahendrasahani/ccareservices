<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h6 class="fw-bold  text-white">Categories</h6>
                <ul class="list-inline hover-animate">
                    <a href="/" class="text-decoration-none text-white ">
                        <li class="pt-2">Home</li>
                    </a>
                    @foreach($main_categories as $main)
                    <a href="{{route('frontend.product.product_list', [Str::slug($main->name)])}}" class="text-decoration-none text-white">
                        <li class="pt-2">{{$main->name}}</li>
                    </a>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold text-white">Information</h6>
                <ul class="list-inline hover-animate">
                    <a href="{{route('frontend.about.view')}}" class="text-decoration-none text-white ">
                        <li class="pt-2">About Us</li>
                    </a>
                    <a href="{{route('frontend.privacy_policy.view')}}" class="text-decoration-none text-white">
                        <li class="pt-2">Privacy Policy</li>
                    </a>
                    <a href="{{route('frontend.terms_and_condition.view')}}" class="text-decoration-none text-white">
                        <li class="pt-2">Terms & Conditions</li>
                    </a>
                    <a href="{{route('frontend.contact_us.view')}}" class="text-decoration-none text-white">
                        <li class="pt-2">Contact Us</li>
                    </a> 
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold  text-white">Extras</h6>
                <ul class="list-inline hover-animate">
                  
                    <a href="" class="text-decoration-none text-white">
                        <li class="pt-2">My Account</li>
                    </a>
                    <a href="" class="text-decoration-none text-white">
                        <li class="pt-2">Returns</li>
                    </a> 
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold  text-white">Need Help</h6>
                <a href="index.html" class="text-decoration-none"><img
                        src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" class="w-50"></a>
                <ul class="list-inline hover-animate"> 
                    <a href="tel:+9198264525856" class="text-decoration-none text-white ">
                        <li class="pt-2"><i class="fa-solid fa-phone"></i>&nbsp +91 7291917070</li>
                    </a>
                    <a href="mailto:testing12@gmail.com" class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-regular fa-envelope"></i>&nbsp info@coolcareservice.in</li>
                    </a>
                    <a href="mailto:testing12@gmail.com" class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-solid fa-location-dot"></i>&nbsp View on map</li>
                    </a> 
                </ul>
                <div class="d-flex list-inline" id="social-media">
                    <a href="https://www.facebook.com/coolcareservicegurgaon/" class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-brands fa-facebook-f"></i></li>
                    </a>
                    <a href="https://twitter.com/coolcaresrvice" class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-solid fa-x"></i> </li>
                    </a>
                    <a href="https://www.instagram.com/coolcare_service_gurgaon/"
                        class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-brands fa-instagram"></i></li>
                    </a>
                    <a href="https://www.linkedin.com/company/coolcare-services/"
                        class="text-decoration-none text-white">
                        <li class="pt-2"><i class="fa-brands fa-linkedin"></i></li>
                    </a>
                </div>

            </div>
            <div class="footer-copyright">
                <hr class="text-white">
                <p style="font-size:8px;color:#e8e8e8; margin: 0;">Gurgaon, Dlf Phase 1, Dlf Phase 2, Dlf Phase 3,
                    Dlf Phase 4, Dlf Phase 5, Sohna Road, Sushant Lok 1-2-3, Palam Vihar,MG road Udyog Vihar Phase
                    1, Udyog Vihar Phase 2, Udyog Vihar Phase 3, Udyog Vihar Phase 4, Udyog Vihar Phase 5, South
                    City 1, South City 2, Sector 1, Sector 4, sector 5,sector 7Sector 9,sector 9a Sector 10, sector
                    10a,Sector 12, Sector 14, Sector 15part1 sector 15 part2, Sector 17, Sector 21, Sector 22,
                    Sector 23, Sector 27, Sector 28,sector 29 Sector 30, Sector 31, Sector 32, Sector 33,sector34,
                    sector 36,Sector 37, sector 37c,sector 37d,sector 38,sector 39,Sector 40, Sector 41, Sector 42,
                    Sector 43, Sector44, sector 45,sector46, Sector 47, sector 48,Sector 49, Sector 50, Sector 51,
                    Sector 52, Sector 54, Sector 55, Sector 56, Sector 57, Sector 74, Sector 75, Sector 76, Sector
                    77, Sector 82, Sector 83, sector 84,sector 90,sector 91,sector 92,sector 95,Sector 103, Sector
                    106, Sector 107, Sector 111, Sector 112, adree city, golf course road, dlf city, vatika city,
                    uniworld garden, vipul world, orchid patel, Mayfield garden, shishpal vihar, patodi road,
                    dawarka express way, imt manesar, imt sector 1,essal tower,Taksila Heights </p>
                <br>
            </div>
        </div>
    </div>
</footer>
<section style="background-color: #509abd">
    <div class="copy-right text-center">
        <span class="text-white" style="font-size: 13px;">Copyright © 2024 </span>
        <a href="index.html" class="text-decoration-none"
            style="text-transform:lowercase; font-size: 13px; color: rgb(246, 246, 246);">coolcareservice.in</a> |
        <span class="text-white" style="font-size: 13px;"> Powered by</span>
        <a href="https://www.ddtsoftwareandecommerce.com/" class="text-decoration-none" target="_blank"
            style="font-size: 13px; color: rgb(255, 255, 255); ">DDT Software & E-comm Pvt Ltd</a>
    </div> 
    <div class="phone-call cbh-phone cbh-green cbh-show  cbh-static" id="clbh_phone_div">
        <a id="WhatsApp-button" href="https://wa.me/+919716016098" target="_blank" class="phoneJs"
            title="WhatsApp 360imagem">
            <div class="cbh-ph-circle"></div>
            <div class="cbh-ph-circle-fill"></div>
            <div class="cbh-ph-img-circle1"></div>
        </a>
    </div> 
</section> 
<a id="back-top" class="text-decoration-none"></a> 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script src="{{url('public/assets/frontend/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="{{url('public/assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/assets/backend/js/backend_custom.js')}}"></script>
<script src="{{url('public/assets/frontend/js/cart.js')}}"></script>
<script src="{{url('public/assets/frontend/js/single_product.js')}}"></script>
<script src="{{url('public/assets/both/js/checkout.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('javascript-section')
</body>

</html>