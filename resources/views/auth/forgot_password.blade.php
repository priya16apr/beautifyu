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
                        <span>Forgot Password</span>
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
                            <h4 class="text-white">Forgot Password Here</h4>
                            <p class="text-white pt-4" style="font-size:16px;">Send Password to your Email Id</p>
                            </div>
                        </div>
                       
                        <div class="col-md-8 col-lg-8 bg-white shadow-lg">
                            <div class="contact__form p-4 pt-4">

                                <div class="col-12">
                                    @if(Session::has('forgot_message'))
                                    <div class="alert alert-{{ Session::get('message_class') }}" role="alert">
                                        <span class="alert-inner--text">{{ Session::get('forgot_message') }}</span>
                                    </div>
                                    {{ Session::forget('forgot_message') }}
                                    @endif 
                                </div>


                                <form name="form2" action="{{route('submit_forgot_pass')}}" method="post">
                                    @csrf
                                        <input type="text" name="user_email" id="user_email" placeholder="Enter Email Id" required />
                                        
                                        <p>By continuing, you agree to <a href="{{url('/content/terms-of-use')}}" target="_blank">BeautifyU's Terms of Use</a> and 
                                        <a href="{{url('/content/privacy-policy')}}" target="_blank">Privacy Policy</a>.</p>
                                        <button type="submit" class="login-btn">Submit</button>  
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

