let baseUrl = document.querySelector('meta[name="base-url"]').content;
$(function () {
    // Your jQuery code here
    // console.log('test working');
    $(document).ready(function ()
    {
        // Toggle search bar visibility
        $("#toggleSearch").click(function ()
        {
            $(".search-bar-open").slideToggle();
        });
    });

    $('#show-hidden-menu').click(function (e) {
        e.preventDefault(); // Prevent the default behavior of the anchor link
        $('#hiddenContent').slideToggle('slow');
        $('#arrow-icon i').toggleClass('fa-arrow-down fa-arrow-up'); 
        
        // Toggle button text
        var buttonText = $('#show-hidden-menu').text().trim();
        $('#show-hidden-menu').text(buttonText === 'View More' ? 'View Less' : 'View More');
    });

    $(document).ready(function (){
        var navbar = $(".navbar"); 
        $(window).scroll(function (){
            if ($(window).scrollTop() >= 100){
                navbar.addClass("scrolled");
            } else{
                navbar.removeClass("scrolled");
            }
        });
    });



    $(document).ready(function (){
        $('#owl-carousel').owlCarousel({
            items: 3,
            loop: true,
            margin: 10,
            nav: true,
            navText: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 1
                }
            }
        });
    });


    $(document).ready(function (){
        $("#my-unique-carousel").owlCarousel({
            items: 3,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 4
                }
            }
        });
    });


    $("#brand-slider").owlCarousel({
        items: 3,
        loop: true,
        margin: 30,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 2000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });

    $(".icon").on("click", function (e){
        e.preventDefault();
        $(this).toggleClass("selected");
    })

    $('#closeButton').click(function (){
        $('#myElement').hide();
    });


    var btn = $('#back-top'); 
    $(window).scroll(function (){
        if ($(window).scrollTop() > 300){
            btn.addClass('show');
        } else{
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e){
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
    }); 


    function setActiveClassByUrl(){
        var currentUrl = window.location.href;
        var links = document.querySelectorAll('.sidebar-menu ul li a');
        links.forEach(function (link){
            if (link.href === currentUrl){
            link.parentElement.classList.add('active');
            }else{
            link.parentElement.classList.remove('active');
            }
          });
        } 
    setActiveClassByUrl();






});
