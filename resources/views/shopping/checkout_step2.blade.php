@extends('layouts.main')

@section('header-seo')
<title>Cart</title>
<meta name="keywords" content="Cel">
<meta name="description" content="Cel">
@endsection

@section('mid-content')

<section class="checkout spad">
    <div class="container">

        <div class="section-title"><h4>Checkout</h4></div>

        <form name="form2" action="{{route('submit_checkout_step2')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="step-headingss1">1. Delivery Address <span><a href="{{ url('/check-out-address-select') }}">Change</a></span></div>    
                    <div class="row">
                        
                        @if($address)      
                                                    
                            <div class="col-md-12">
                                <div class="p-2 text-13">
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
                    <hr>
                    <div class="step-headingss">2. Payment Method </div>

                    <div class="row bdr-1 m-3">
                        <div class="col-md-12 mt-3">
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
                            <input type="submit" class="btn-sm btn mb-3 btn-primary" value="use this payment method" />
                        </div>
                    </div>

                    <br/>
                    <div class="step-headingss1">3. Review items and delivery </div>
                
                </div>

                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Order Summary</h5>

                        <div class="checkout__order__total">
                            <ul>
                                <li>Total <span>₹ @php echo Session::get('cart_total'); @endphp</span></li>
                                <input type="hidden" name="total_amt" id="total_amt" value="@php echo Session::get('cart_total'); @endphp" />
                                <li>Delivery Charges <span class="freee">Free</span></li>
                            </ul>
                        </div>

                        <div class="checkout__order__youpay">
                            <ul>
                                <li>You Pay Total<span>₹ @php echo Session::get('cart_total'); @endphp</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
       
    </div>
</section>

@endsection