<section class="sidebar col-md-3">
    <div class="container">
        <div class="">
            <div class="card" id="">
                <div class="card-body ">
                    <div class="circle">
                        <img class="my-profile"
                            src="
                            @if(Auth::user()->profile == '' || Auth::user()->profile == null)
                            https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg
                            @else
                            {{url(Auth::user()->profile)}}
                           @endif
                            ">
                    </div>
                    <div class="identity">
                        <h3>{{Auth::user()->name}}</h3>
                        <p>{{Auth::user()->email}}</p>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li class="active"><a href="{{route('frontend.user.dashboar.view')}}"><i class="fa-solid fa-user-tie"></i>Dashboard</a> </li>
                    <!-- <li><a href="{{route('frontend.user.discount.view')}}"><i class="fa-solid fa-tag"></i>Discount</a></li> -->
                    <li><a href="{{route('frontend.user.purchase_history.view')}}"><i class="fa-solid fa-clock-rotate-left"></i>Purchase History</a> </li>
                    <li><a href="{{route('frontend.user.manage_profile.view')}}"><i class="fa-solid fa-user-pen"></i>Manage Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

