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
            
                <x-myaccount-sidebar :userinfo=$userinfo />

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="acc-heading">Edit Address</div>
                            <div class="product__item">

                                <form name="form1" action="{{route('myaccount_submit_editaddress')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Pincode <span>*</span></label>
                                                <input type="hidden" name="address_id" id="address_id" value="{{$detail->id}}" required />
                                                <input type="text" class="fldone" name="edit_pincode" id="edit_pincode" value="{{$detail->pincode}}" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>Full Name <span>*</span></label>
                                                <input type="text" class="fldone" name="edit_name" id="edit_name" value="{{$detail->full_name}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>Email Address <span>*</span></label>
                                                <input type="email" name="edit_email" id="edit_email" value="{{$detail->email}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>Address <span>*</span></label>
                                                <input type="text" class="fldone" placeholder="Flat/House No., Street Address" name="edit_address1" id="edit_address1"
                                                value="{{$detail->address_line1}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label> &nbsp;</label>
                                                <input type="text" class="fldone" placeholder="Locality/Landmark" name="edit_address2" id="edit_address2" value="{{$detail->address_line2}}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>City <span>*</span></label>
                                                <input type="text" class="fldone" name="edit_city" id="edit_city" value="{{$detail->city}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>State <span>*</span></label>
                                                <input type="text" class="fldone" name="edit_state" id="edit_state" value="{{$detail->state}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>Mobile Number <span>*</span></label>
                                                <input type="text" class="fldone" name="edit_mobile" id="edit_mobile" value="{{$detail->mobile}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="checkout__form__input">
                                                <label>Alternate Mobile Number </label>
                                                <input type="text" class="fldone" name="edit_alter_mobile" id="edit_alter_mobile" value="{{$detail->alter_mobile}}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input choosee">
                                                <label>Address Type</label>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Home" @if($detail->address_type=='Home')  checked @endif />
                                                    <label class="form-check-label mt-0" for="home">Home/Personal</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Office" @if($detail->address_type=='Office')  checked @endif />
                                                    <label class="form-check-label mt-0" for="office">Office/Commercial</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Other" @if($detail->address_type=='Other')  checked @endif />
                                                    <label class="form-check-label mt-0" for="other">Other</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <button class="deliver-btn">Save and Submit</button>
                                        </div>
                                    </div>
                                </form> 
                                    
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

