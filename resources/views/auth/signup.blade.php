@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_register_title']}}</title>
    <meta name="description" content="{{$setting['seo_register_description']}}">
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
                            
                                <div class="col-12">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach         
                                        </ul>
                                    </div>
                                    @endif
                                </div>    
                                
                                <div class="col-12">
                                    @if(Session::has('auth_message'))
                                    <div class="alert alert-{{ Session::get('message_class') }}" role="alert">
                                        <span class="alert-inner--text">{{ Session::get('auth_message') }}</span>
                                    </div>
                                    {{ Session::forget('auth_message') }}
                                    @endif 
                                </div>
                            
                            
                                <form name="form1" action="{{route('submit_signup')}}" method="post">
                                    @csrf
                                    <input type="text" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}" required />
                                    <input type="email" name="email" id="email" placeholder="Enter Email Id" value="{{ old('email') }}" required />
                                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="{{ old('mobile') }}" required />
                                    <input type="password" name="password" id="password" placeholder="Enter Password" required />
                                    
                                    <p>By continuing, you agree to <a href="{{url('/content/terms-of-use')}}" target="_blank">BeautifyU's Terms of Use</a> and 
                                    <a href="{{url('/content/privacy-policy')}}" target="_blank">Privacy Policy</a>.</p>
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


@section('footer-js')


@endsection
    

