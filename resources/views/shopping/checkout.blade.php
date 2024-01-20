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
                    <span>Checkout</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="checkout spad">
    <div class="container">

        <form name="form2" action="{{route('submit_order')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        
                        @if(count($address)>0)                           
                            @foreach($address as $addresss)
                            <div class="col-md-4">
                                <div class="bdr-1 p-4">
                                    <h5>{{ $addresss->address_type }}</h5>
                                    <p>{{ $addresss->full_name }}</p>
                                    <p>{{ $addresss->address_line1 }}, {{ $addresss->address_line2 }}, {{ $addresss->city }}, {{ $addresss->state }}, {{ $addresss->pincode }}</p>
                                    <p>Phone: {{ $addresss->mobile }}</p>

                                    <input type="radio" name="selected_address" id="selected_address" value="{{ $addresss->id }}"
                                    @if ($loop->first) checked  @endif />
                                    <!-- <button class="deliver-btn-2">Deliver Here</button> -->
                                    
                                    <!-- <hr />
                                    <div class="d-flex">
                                        <a href="" class="ms-auto text-dark text-13">Edit</a>
                                        <a href="" class="ml-auto text-dark text-13">Delete</a>
                                    </div> -->
                                </div>
                            </div>
                            @endforeach 
                        @endif

                        <!-- <div class="col-md-4">
                            <button class="btn btn-outline-dark">+ Add New Address</button>
                        </div> -->

                        <!-- <div class="col-md-12 mt-5">
                            New address
                        </div> -->

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Order Summary</h5>

                        <div class="checkout__order__total">
                            <ul>
                                <li>Total <span>Rs @php echo Session::get('cart_total'); @endphp</span></li>
                                <input type="hidden" name="total_amt" id="total_amt" value="@php echo Session::get('cart_total'); @endphp" />
                                <li>Delivery Charges <span class="freee">Free</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__youpay">
                            <ul>
                                <li>You Pay <span>Rs @php echo Session::get('cart_total'); @endphp</span></li>
                            </ul>
                        </div>
                        <button type="submit" class="site-btn">Place oder</button>
                    </div>
                </div>
            </div>
        </form>
       
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <form name="form1" action="{{route('submit_addaddress')}}" method="post">
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
</section>

@endsection