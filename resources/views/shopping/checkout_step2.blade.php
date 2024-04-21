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
                    <span>Checkout Step 2</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="checkout spad">
    <div class="container">

        <form name="form2" action="{{route('submit_checkout_step2')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                1. Delivery Address: <a href="{{ url('/check-out-address-select') }}">Change</a><br/>
                    <div class="row">
                        
                        @if($address)      
                                                     
                            <div class="col-md-12">
                                <div class="p-2">
                                    <label>
                                        [{{ $address->address_type }}] &nbsp;
                                        <b>{{ $address->full_name }}</b>, 
                                        {{ $address->address_line1 }}, {{ $address->address_line2 }}, {{ $address->city }}, {{ $address->state }}, {{ $address->pincode }},
                                        Phone: {{ $address->mobile }}
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="selected_address"  value="{{ $address->id }}" />
                        @endif
                        
                    </div>

                2. Payment Method 
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-2">
                            <label>
                                <input type="radio" name="pmethod"  value="cod" checked />&nbsp; Cash on Delivery/Pay on Delivery
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="p-2">
                            <label>
                                <input type="radio" name="pmethod"  value="upi" />&nbsp; UPI
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="deliver-btn" value="use this payment method" />
                    </div>
                </div>

                <br/><br/>
                
                3. Review items and delivery 
                
                </div>

                <div class="col-lg-3">
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
                        <!-- <button type="submit" class="site-btn">Place oder</button> -->
                    </div>
                </div>
            </div>
        </form>
       
    </div>
</section>

@endsection