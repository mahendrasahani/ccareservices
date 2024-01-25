<section class="sidebar col-md-3">
    <div class="container">
        <div class="">
            <div class="card" id="">
                <div class="card-body ">
                    <div class="circle">
                        <img class="my-profile"
                            src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                    </div>
                    <div class="identity">
                        <h3>Name</h3>
                        <p>customer@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li class="active"><a href="./dashboard.php"><i class="fa-solid fa-user-tie"></i>Dashboard</a> </li>
                    <li><a href="#"><i class="fa-solid fa-tag"></i>Discount</a></li>
                    <li><a href="./purchase-history.php"><i class="fa-solid fa-clock-rotate-left"></i>Purchase History</a> </li>
                    <li><a href="./registration.php"><i class="fa-solid fa-user-pen"></i>Manage Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script>
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
</script>