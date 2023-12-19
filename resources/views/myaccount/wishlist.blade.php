@extends('layouts.main')

@section('header-seo')
    
@endsection

@section('mid-content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                
            
            <div class="sidebar__categories">
                <div class="section-title">
                    <h4>My Account</h4>
                </div>
                <div>
                    <div>
                        <div class='card'>
                            <div class='card-heading'><a href="{{route('myaccount')}}">My Profile</a></div>
                            <div class='card-heading'><a href="{{route('myaccount_address')}}">My Address</a></div>
                            <div class='card-heading'><a href="{{route('myaccount_orders')}}">My Orders</a></div>
                            <div class='card-heading'><a href="{{route('myaccount_wishlist')}}">My Wishlst</a></div>
                            <div class='card-heading'><a href="{{route('myaccount_password_change')}}">Change Password</a></div>
                            
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        Wishlist
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

