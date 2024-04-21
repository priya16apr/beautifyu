@extends('layouts.main')

@section('header-seo')
    <title>Cart</title>
    <meta name="keywords" content="Cel">
    <meta name="description" content="Cel">
@endsection

@section('mid-content')

<div class="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>

            <div class="col-lg-8">
                <div class="row">

                    <div class="col-md-4 col-lg-4 bg-info">
                        <div class="p-3 pt-4">
                        <h4 class="text-white">Forgot Password</h4>
                        <p class="text-white pt-4" style="font-size:16px;">Don't worry we will send Password to your Email Id</p>
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
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Email Id</label>
                                    <div class="col-sm-8">
                                    <input type="text" name="user_email" id="user_email" placeholder="Enter Email Id" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="login-btn">Submit</button> 
                                    </div>
                                </div>

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

