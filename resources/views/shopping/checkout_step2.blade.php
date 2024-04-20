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

                                    <label class="deliver-btn-2">
                                        <input type="radio" name="selected_address" id="selected_address" value="{{ $addresss->id }}"
                                        @if ($loop->first) checked  @endif /> Deliver Here
                                    </label>
                                </div>
                            </div>
                            @endforeach 
                        @endif

                        <div class="col-md-4">
                            <button class="btn btn-outline-dark">+ Add New Address</button>
                        </div>

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
                        <!-- <button type="submit" class="site-btn">Place oder</button> -->
                    </div>
                </div>
            </div>
        </form>
       
    </div>
</section>

@endsection