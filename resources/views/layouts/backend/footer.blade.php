
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>© CoolCare Services. 2024 All Rights Reserved.</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
        let draw = Chart.controllers.line.prototype.draw;
        Chart.controllers.line = Chart.controllers.line.extend({
            draw: function ()
            {
                draw.apply(this, arguments);
                let ctx = this.chart.chart.ctx;
                let _stroke = ctx.stroke;
                ctx.stroke = function ()
                {
                    ctx.save();
                    ctx.shadowColor = 'rgb(0, 0, 0, .16)';
                    ctx.shadowBlur = 3;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 3;
                    _stroke.apply(this, arguments)
                    ctx.restore();
                }
            }
        });

        AIZ.plugins.chart('#graph-1', {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [{
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
                    fill: false,
                    borderColor: "rgb(221, 65, 36)",
                    borderWidth: 4,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        ticks: {
                            min: 0,
                            max: 150,
                        },
                    }],
                    xAxes: [{
                        display: false,
                    }],
                    ticks: {
                        min: 0
                    },
                },
            }
        })

        AIZ.plugins.chart('#graph-2', {
            type: 'bar',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [{
                    label: 'Sales ($)',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 186.11, 0, 0, 0],
                    backgroundColor: '#DD4124',
                    borderColor: '#DD4124',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#fff',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Roboto',
                            fontSize: 10,
                            beginAtZero: true
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fff'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Roboto',
                            fontSize: 10
                        },
                        barThickness: 20,
                        barPercentage: .5,
                        categoryPercentage: .5,
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
        AIZ.plugins.chart('#graph-3', {
            type: 'bar',
            data: {
                labels: ['Women Clothing &amp; Fashion', 'Men Clothing &amp; Fashion', 'Baby &amp; Kids', 'Sports &amp; Outdoor', 'Automobile &amp; Motorcycle', 'Computer &amp; Accessories', 'Cellphones &amp; Tabs', 'Beauty, Health &amp; Hair',],
                datasets: [{
                    label: 'Sales ($)',
                    data: [14653.64, 2660.28, 3295.15, 3823.21, 13784.26, 30223.52, 40512.3, 2474.56,],
                    backgroundColor: '#91A8D0',
                    borderColor: '#91A8D0',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#fff',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Roboto',
                            fontSize: 10,
                            beginAtZero: true
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fff'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Roboto',
                            fontSize: 10
                        },
                        barThickness: 20,
                        barPercentage: .5,
                        categoryPercentage: .5,
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
    <!-- Add this script block after including Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function ()
        {
            // Get the canvas element
            var ctx = document.getElementById('graph-1').getContext('2d');

            // Sample data for the chart
            var data = {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Number of Orders',
                    backgroundColor: 'rgba(255, 111, 97, 0.5)',
                    borderColor: '#FF6F61',
                    data: [10, 15, 7, 25, 18],
                }]
            };

            // Configuration options for the chart
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Create the chart
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
    <!-- Add this script block after including Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function ()
        {
            // Sales stat chart
            var ctx1 = document.getElementById('graph-2').getContext('2d');
            var data1 = {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: 'rgba(255, 111, 97, 0.5)',
                    borderColor: '#FF6F61',
                    data: [200, 150, 250, 180, 220],
                }]
            };
            var options1 = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            var myChart1 = new Chart(ctx1, {
                type: 'line',
                data: data1,
                options: options1
            });

            // Sales by Category chart
            var ctx2 = document.getElementById('graph-3').getContext('2d');
            var data2 = {
                labels: ['Category A', 'Category B', 'Category C', 'Category D', 'Category E'],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: ['#FF6F61', '#66B2FF', '#FFD700', '#98FB98', '#FF6347'],
                    data: [150, 120, 200, 180, 250],
                }]
            };
            var options2 = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: data2,
                options: options2
            });
        });
    </script>

    <script src="{{url('public/assets/backend/plugins/common/common.min.js')}}"></script>
    <script src="{{url('public/assets/backend/js/custom.min.js')}}"></script> 
    <script src="{{url('public/assets/backend/js/settings.js')}}"></script>
    <script src="{{url('public/assets/backend/js/gleek.js')}}"></script>
    <script src="{{url('public/assets/backend/js/styleSwitcher.js')}}"></script>
    <!-- Chartjs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{url('public/assets/backend/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Circle progress -->
    <script src="{{url('public/assets/backend/plugins/circle-progress/circle-progress.min.js')}}"></script>
    <!-- Datamap -->
    <script src="{{url('public/assets/backend/plugins/d3v3/index.js')}}"></script>
    <script src="{{url('public/assets/backend/plugins/topojson/topojson.min.js')}}"></script>
    <script src="{{url('public/assets/backend/plugins/datamaps/datamaps.world.min.js')}}"></script>
    <!-- Morrisjs -->
    <script src="{{url('public/assets/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{url('public/assets/backend/plugins/morris/morris.min.js')}}"></script>
    <!-- Pignose Calender -->
    <script src="{{url('public/assets/backend/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('public/assets/backend/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
    <!-- ChartistJS -->
    <script src="{{url('public/assets/backend/plugins/chartist/js/chartist.min.js')}}"></script>
    <script src="{{url('public/assets/backend/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{url('public/assets/backend/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{url('public/assets/backend/js/backend_custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"
        integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('public/assets/backend/plugins/highlightjs/highlight.pack.min.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{url('public/assets/frontend/js/cart.js')}}"></script>
    <script src="{{url('public/assets/frontend/js/single_product.js')}}"></script>
    <script src="{{url('public/assets/both/js/checkout.js')}}"></script>


    <script>
        $(document).ready(function ()
        {
            $('#icon-menuclick').click(function ()
            {
                $('#nmk-sidebar').toggleClass("n-sidebar nk-sidebar")
                $('#navToggle-header').toggleClass("nav-header-1 nav-header")

                $('#main-wrapper').toggleClass("menu-toggle");

                $(".hamburger").toggleClass("is-active");

            });
        });
    </script>
    <script>
        $('.slider-bar').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>

    
    @yield('javascript-section')

</body>

</html>