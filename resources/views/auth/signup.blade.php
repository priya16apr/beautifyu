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
                        <span>Signup</span>
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
                                <h4 class="text-white">Looks like you're new here!</h4>
                                <p class="text-white pt-4" style="font-size:16px;">Sign up with your mobile number to get started</p>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 bg-white shadow-lg">
                            <div class="contact__form p-4 pt-4">
                                <form name="form1" action="{{route('submit_signup')}}" method="post">
                                        @csrf
                                        <input type="text" name="name" id="name" placeholder="Enter Name" required />
                                        <input type="email" name="email" id="email" placeholder="Enter Email Id" required />
                                        <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" required />
                                        <input type="password" name="password" id="password" placeholder="Enter Password" required />
                                        
                                        <p>By continuing, you agree to <a href="" target="_blank">BeautifyU's Terms of Use</a> and <a href="" target="_blank">Privacy Policy</a>.</p>
                                        <!-- <button type="submit" class="login-btn">Continue</button> -->
                                        <input type="submit" />
                                </form>
                            
                                <div class="text-center pt-5" style="font-weight:600"> <a href="user-login">Existing User? Log in</a> </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

@endsection

