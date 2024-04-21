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
                            <h4 class="text-white">Verify Mobile Number</h4>
                            <p class="text-white pt-4" style="font-size:16px;">Otp is sent to your mobile number, please submit here to verify your details.</p>
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

                            <form name="form1" action="{{route('submit_signup_step2')}}" method="post">
                                @csrf
                                <input type="text" name="temp_otp" id="temp_otp" class="numberonly mb-4" placeholder="Enter OTP" required />
                                <input type="hidden" name="handle" id="handle" value="{{$handle}}" />
                                <button type="submit" class="login-btn">Verify</button> 
                            </form>
                        
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

<script>

    function step1()
    {
        mobile = jQuery('#mobile').val();
        alert(mobile);

        
        jQuery.ajax({
            url     :   "/ajax/signup-step1",
            data    :   'mobile='+mobile
            type    :   'GET',
            success:function(data)
            {
                //var datas = data.split('***');

                // if(datas[0]=='otp_ok')
                // {
                //     jQuery('#otp_input').show();
                // }
                // else
                // {

                // }
            }
        });
    }

</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection

