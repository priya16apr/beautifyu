<div class="sidebar__categories col-lg-3 col-md-3 bdr-rgt-1">
    <div class="section-title"><h4>My Account</h4></div>
    <div>
        <div class='col-12 mx-0 p-0'>

            <div class="acc-side-cont">
                <div class="acc-icon-pro"><i class="fa fa-user"></i></div>
                <p>{{$userinfo->name}}</p>
                <p class="text-13 text-grey">{{$userinfo->email}}</p>
            </div>

            <div class='card-heading-1'><a href="{{route('myaccount')}}"><i class="fa fa-user"></i> My Profile</a></div>
            <div class='card-heading-1'><a href="{{route('myaccount_address')}}"><i class="fa fa-map"></i> My Address</a></div>
            <div class='card-heading-1'><a href="{{route('myaccount_orders')}}"><i class="fa fa-file"></i> My Orders</a></div>
            <!-- <div class='card-heading'><a href="{{route('myaccount_wishlist')}}">My Wishlst</a></div> -->
            <div class='card-heading-1'><a href="{{route('myaccount_password_change')}}"><i class="fa fa-lock"></i> Change Password</a></div>
        
        </div>
    </div>
</div>