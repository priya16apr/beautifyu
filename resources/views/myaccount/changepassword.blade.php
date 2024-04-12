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
                        <a href="{{route('myaccount')}}">My Account</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">

            <x-myaccount-sidebar :userinfo=$userinfo />

            <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <div class="acc-heading">Change Password</div>
                            <div class="product__item">

                            <div class="col-12">
                                @if(Session::has('message'))
                                <div class="alert alert-{{ Session::get('message_class') }}" role="alert">
                                    <span class="alert-inner--text">{{ Session::get('message') }}</span>
                                </div>
                                {{ Session::forget('message') }}
                                @endif 
                            </div>

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

                            <form name="form1" action="{{route('myaccount_password_submit')}}" method="post">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="checkout__form__input">
                                        <label>Old Password :</label>
                                        <input type="password" name="old_password" id="old_password" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="checkout__form__input">
                                        <label>New Password : </label>
                                        <input type="password" name="new_password" id="new_password" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="checkout__form__input">
                                        <label>Confirm Password :</label>
                                        <input type="password" name="confirmed_password" id="confirmed_password" required />
                                        </div>
                                    </div>
                                </div>

                                <input class="deliver-btn" type="submit" value="Update Password" />

                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

