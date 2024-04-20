@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_login_title']}}</title>
    <meta name="description" content="{{$setting['seo_login_description']}}">
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

                                <div class="col-12">
                                    @if(Session::has('auth_message'))
                                    <div class="alert alert-{{ Session::get('message_class') }}" role="alert">
                                        <span class="alert-inner--text">{{ Session::get('auth_message') }}</span>
                                    </div>
                                    {{ Session::forget('auth_message') }}
                                    @endif 
                                </div>


                                <form name="form2" action="{{route('submit_login')}}" method="post">
                                    @csrf
                                        <input type="text" name="user_mobile" id="user_mobile" placeholder="Enter Mobile Number" required />
                                        <input type="password" name="user_password" id="user_password" placeholder="Enter Password" required />
                                        <input type="hidden" name="handle" id="handle" value="{{$handle}}" />
                                        
                                        <p>By continuing, you agree to <a href="{{url('/content/terms-of-use')}}" target="_blank">BeautifyU's Terms of Use</a> and 
                                        <a href="{{url('/content/privacy-policy')}}" target="_blank">Privacy Policy</a>.</p>
                                        <button type="submit" class="login-btn">Login</button>  
                                        <a href="{{route('forgot_password')}}" class="float-right text-reset pt-2">Forgot Password?</a>
                                </form>
                            
                                <div class="text-center pt-5" style="font-weight:600"> 
                                    @if($handle) 
                                        <a href="user-basic-signup?handle=beautifyu_checkout_in">New to BeautifyU? Create an account</a> 
                                    @else
                                        <a href="user-basic-signup">New to BeautifyU? Create an account</a> 
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

@endsection

