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
                        <span>Edit Address</span>
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
                        <h4>Edit Address</h4>
                    </div>
                    <div>
                        <x-myaccount-sidebar />
                    </div>
                </div>

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="product__item">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <form name="form1" action="{{route('myaccount_submit_editaddress')}}" method="post">
                                                    @csrf
                                                <h5>Edit Address</h5>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>Pincode <span>*</span></p>
                                                            <input type="hidden" name="address_id" id="address_id" value="{{$detail->id}}" required />
                                                            <input type="text" name="edit_pincode" id="edit_pincode" value="{{$detail->pincode}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>Full Name <span>*</span></p>
                                                            <input type="text" name="edit_name" id="edit_name" value="{{$detail->full_name}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>Email Address <span>*</span></p>
                                                            <input type="email" name="edit_email" id="edit_email" value="{{$detail->email}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="checkout__form__input">
                                                            <p>Address <span>*</span></p>
                                                            <input type="text" placeholder="Flat/House No., Street Address" name="edit_address1" id="edit_address1"
                                                            value="{{$detail->address_line1}}" required />
                                                            <input type="text" placeholder="Locality/Landmark" name="edit_address2" id="edit_address2" value="{{$detail->address_line2}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>City <span>*</span></p>
                                                            <input type="text" name="edit_city" id="edit_city" value="{{$detail->city}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>State <span>*</span></p>
                                                            <input type="text" name="edit_state" id="edit_state" value="{{$detail->state}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>Mobile Number <span>*</span></p>
                                                            <input type="text" name="edit_mobile" id="edit_mobile" value="{{$detail->mobile}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="checkout__form__input">
                                                            <p>Alternate Mobile Number </p>
                                                            <input type="text" name="edit_alter_mobile" id="edit_alter_mobile" value="{{$detail->alter_mobile}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="checkout__form__input choosee">
                                                            <p>Address Type</p>
                                                            <label><input type="radio" name="address_type" id="address_type" value="Home"
                                                            @if($detail->address_type=='Home')  checked @endif /> <span>Home / Personal</span></label>

                                                            <label><input type="radio" name="address_type" id="address_type" value="Office"
                                                            @if($detail->address_type=='Office')  checked @endif /> 
                                                            <span>Office / Commercial</span></label>

                                                            <label><input type="radio" name="address_type" id="address_type" value="Other"
                                                            @if($detail->address_type=='Other')  checked @endif />
                                                                <span>Other</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <button class="deliver-btn">Save and Submit</button>
                                                        <!-- <input type="submit" value="Save and Submit" /> -->
                                                    </div>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

