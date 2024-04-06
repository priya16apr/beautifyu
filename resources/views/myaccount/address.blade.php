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
                        <span>My Account</span>
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
                        <h4>My Account</h4>
                    </div>
                    <div>
                        <x-myaccount-sidebar />
                    </div>
                </div>

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @if(count($address)>0)                           
                            @foreach($address as $addresss)
                            <div class="col-md-4">
                                <div class="bdr-1 p-4">
                                    <h5>{{ $addresss->address_type }}</h5>
                                    <p>{{ $addresss->full_name }}</p>
                                    <p>{{ $addresss->address_line1 }}, {{ $addresss->address_line2 }}, {{ $addresss->city }}, {{ $addresss->state }}, {{ $addresss->pincode }}</p>
                                    <p>Phone: {{ $addresss->mobile }}</p>

                                    <hr />
                                    <div class="d-flex">
                                        <a href="{{route('myaccount_address_edit',$addresss->id)}}" class="ms-auto text-dark text-13">Edit</a>
                                        <a href="{{route('myaccount_submit_deladdress',$addresss->id)}}" class="ml-auto text-dark text-13">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <form name="form1" action="{{route('myaccount_submit_addaddress')}}" method="post">
                                        @csrf
                                    <h5>New Delivery Address</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Pincode <span>*</span></p>
                                                <input type="hidden" name="customerid" id="customerid" value="{{ Session::get('beautify_customer')->id }}" required />
                                                <input type="text" name="add_pincode" id="add_pincode" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Full Name <span>*</span></p>
                                                <input type="text" name="add_name" id="add_name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Email Address <span>*</span></p>
                                                <input type="email" name="add_email" id="add_email" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input">
                                                <p>Address <span>*</span></p>
                                                <input type="text" placeholder="Flat/House No., Street Address" name="add_address1" id="add_address1" required />
                                                <input type="text" placeholder="Locality/Landmark" name="add_address2" id="add_address2" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>City <span>*</span></p>
                                                <input type="text" name="add_city" id="add_city" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>State <span>*</span></p>
                                                <input type="text" name="add_state" id="add_state" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Mobile Number <span>*</span></p>
                                                <input type="text" name="add_mobile" id="add_mobile" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Alternate Mobile Number </p>
                                                <input type="text" name="add_alter_mobile" id="add_alter_mobile" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input choosee">
                                                <p>Address Type</p>
                                                <label><input type="radio" name="address_type" id="address_type" value="Home" checked /> <span>Home /
                                                        Personal</span></label>

                                                <label><input type="radio" name="address_type" id="address_type" value="Office" /> <span>Office /
                                                        Commercial</span></label>

                                                <label><input type="radio" name="address_type" id="address_type" value="Other" />
                                                    <span>Other</span></label>
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

