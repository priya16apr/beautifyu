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
                    <span>Checkout Step 1</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="checkout spad">
    <div class="container">

        <form name="form2" action="{{route('submit_check_out_step1')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                1. Select a delivery address:<br/>
                    <div class="row">
                        
                        @if(count($address)>0)      
                                                     
                            @foreach($address as $addresss)
                            <div class="col-md-12">
                                <div class="p-2">
                                    <label>
                                        <input type="radio" name="selected_address" id="selected_address" value="{{ $addresss->id }}"
                                        @if ($loop->first) checked  @endif />
                                        &nbsp;&nbsp;
                                        [{{ $addresss->address_type }}] &nbsp;
                                        <b>{{ $addresss->full_name }}</b>, 
                                        {{ $addresss->address_line1 }}, {{ $addresss->address_line2 }}, {{ $addresss->city }}, {{ $addresss->state }}, {{ $addresss->pincode }},
                                        Phone: {{ $addresss->mobile }}
                                    </label>
                                </div>
                            </div>
                            @endforeach 
                        @endif

                        <div class="col-md-12">
                            <div class="p-2">
                                <!-- <button class="btn">+ Add New Address</button> -->
                                <a href="" class="btn">+ Add New Address</a>
                            </div>
                            <input type="submit" class="deliver-btn" value="use this address" />
                        </div>

                        
                    </div>

                2. Payment Method <br/><br/>
                
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