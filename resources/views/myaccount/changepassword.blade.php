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
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="product__item">


                            <form name="form1" action="{{route('myaccount_password_submit')}}" method="post">
                                @csrf
                                Old Password : <input type="password" name="old_password" id="old_password" required /><br/>
                                New Password : <input type="password" name="new_password" id="new_password" required /><br/>
                                Confirm Password : <input type="password" name="confirm_password" id="confirm_password" required /><br/>
                                <input type="submit" value="Password Update" />
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

