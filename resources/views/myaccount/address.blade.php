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
                        <span>My Address</span>
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
                        <div class="col-md-4">
                            <div class="bdr-dashed p-3 hgt-address-box-1">
                                <p><a href="#add-addresss"><i class="fa fa-plus"></i>
                                Add Address</a></p>
                            </div>
                        </div>

                        @if(count($address)>0)                           
                            @foreach($address as $addresss)
                            <div class="col-md-4 mb-4">
                                <div class="bdr-1 p-3 hgt-address-box ">
                                    <div class="acc-heading1">
                                        @if($addresss->is_default=='Yes') 
                                            Default Address 
                                            <span class="tagg">{{ $addresss->address_type }}</span>
                                        @else 
                                            &nbsp; 
                                            <span class="tagg">{{ $addresss->address_type }}</span>
                                        @endif
                                    </div>

                                    <p><b>{{ $addresss->full_name }}</b></p>
                                    <p>{{ $addresss->address_line1 }}, {{ $addresss->address_line2 }}, {{ $addresss->city }}, {{ $addresss->state }}, {{ $addresss->pincode }}</p>
                                    <p>Phone: {{ $addresss->mobile }}</p>

                                    <hr />
                                    <div class="d-flex position-bottom bdr-top">
                                        <a href="{{route('myaccount_address_edit',$addresss->id)}}" class="ms-auto text-13">Edit</a> | 
                                        <a href="{{route('myaccount_submit_deladdress',$addresss->id)}}" onclick="return confirm('Are you sure, you want to delete this address?')" class="text-13">Remove</a> 
                                        @if($addresss->is_default=='No') 
                                        | <a href="{{route('myaccount_address_default',$addresss->id)}}" class="text-13">Set as Default</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                        @endif

                    </div>

                    <div class="row my-3">
                        <div class="col-lg-12">
                            <div class="row mx-2" id="add-addresss">
                                
                                <form name="form1" action="{{route('myaccount_submit_addaddress')}}" method="post">
                                    @csrf
                                    <div class="acc-heading mt-4">New Delivery Address</div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Pincode <span>*</span></label>
                                                <input type="hidden" name="customerid" id="customerid" value="{{ Session::get('beautify_customer')->id }}" required />
                                                <input type="text" name="add_pincode" id="add_pincode" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Full Name <span>*</span></label>
                                                <input type="text" class="fldone" name="add_name" id="add_name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Email Address <span>*</span></label>
                                                <input type="email" class="fldone" name="add_email" id="add_email" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Address <span>*</span></label>
                                                <input type="text" class="fldone" placeholder="Flat/House No., Street Address" name="add_address1" id="add_address1" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label> &nbsp; <span></span></label>
                                                <input type="text" class="fldone" placeholder="Locality/Landmark" name="add_address2" id="add_address2" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>City <span>*</span></label>
                                                <input type="text" class="fldone" name="add_city" id="add_city" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>State <span>*</span></label>
                                                <input type="text" class="fldone" name="add_state" id="add_state" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Mobile Number <span>*</span></label>
                                                <input type="text" class="fldone" name="add_mobile" id="add_mobile" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <label>Alternate Mobile Number </label>
                                                <input type="text" class="fldone" name="add_alter_mobile" id="add_alter_mobile" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="checkout__form__input choosee">
                                                <label>Address Type</label>
                                                @if(count($address)>0)
                                                    <input type="hidden" name="is_default" value="No" />
                                                @else
                                                    <input type="hidden" name="is_default" value="Yes" />
                                                @endif
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Home" checked />
                                                    <label class="form-check-label mt-0" for="home">Home/Personal</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Office" />
                                                    <label class="form-check-label mt-0" for="office">Office/Commercial</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Other" />
                                                    <label class="form-check-label mt-0" for="other">Other</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
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
    </section>


@endsection

