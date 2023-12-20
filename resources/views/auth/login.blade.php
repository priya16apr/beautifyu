@extends('layouts.main')

@section('header-seo')
    <title>Cart</title>
    <meta name="keywords" content="Cel">
    <meta name="description" content="Cel">
@endsection

@section('mid-content')

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="row">

                        <div class="col-md-4 col-lg-4 bg-info">
                            <div class="p-3 pt-4">
                            <h4 class="text-white">Login Here</h4>
                            <p class="text-white pt-4" style="font-size:16px;">Get access to your Profile, Orders, Wishlist and Recommendations</p>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-8 bg-white shadow-lg">
                            <div class="contact__form p-4 pt-4">
                                <form name="form2" action="{{route('submit_login')}}" method="post">
                                    @csrf
                                        <input type="text" name="user_mobile" id="user_mobile" placeholder="Enter Mobile Number" required />
                                        <input type="password" name="user_password" id="user_password" placeholder="Enter Password" required />
                                        
                                        <p>By continuing, you agree to <a href="{{url('/content/tttttt')}}" target="_blank">BeautifyU's Terms of Use</a> and 
                                        <a href="{{url('/content/privacy-policy')}}" target="_blank">Privacy Policy</a>.</p>
                                        <button type="submit" class="login-btn">Login</button>  
                                        <!-- <a href="" class="float-right text-reset pt-2">Forgot Password?</a> -->
                                </form>
                            
                                <div class="text-center pt-5" style="font-weight:600"> <a href="user-signup">New to BeautifyU? Create an account</a> </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

@endsection

