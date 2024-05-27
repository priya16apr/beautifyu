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

        <form name="form2" action="{{route('submit_checkout_step3')}}" method="post" class="checkout__form">
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

                    <div class="step-headingss1">2. Payment Method  <span><a href="{{ url('/check-out-pay-select') }}">Change</a></span></div>
                    <div class="row">
                        @if($pMethod)
                            <div class="col-md-12">
                                <div class="p-2 text-13">
                                    <label>{{ $pMethod }} / Pay on Delivery</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>

                    <div class="step-headingss">3. Review items and delivery </div>
                        @if(count($cart)>0)
                            <div class="row bdr-1 m-3">
                                <div class="col-lg-12 p-3">
                                    @foreach($cart as $carts)
                                        <div class="cart-bag-page">
                                            <div class="cart-bag-img">
                                                <img src="{{ $carts->product_image }}" alt="{{ $carts->product_name }}">
                                            </div>
                                            <h6>{{ $carts->product_name }}</h6>

                                            <div class="">
                                                <x-product-rating :product="$carts->product" label="no" />
                                                <div class="col">
                                                    <div class="detail-p-color">
                                                        Color : <span style="background:{{ $carts->product_color }}"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <p>Quantity: {{ $carts->product_qty }}</p>
                                            <div class="product__details__price">
                                                <span class="sign">₹</span> {{ $carts->product_price }} 
                                                <span>MRP.: ₹ {{ $carts->product_mrp }} </span>
                                            </div>                
                                        </div>
                                    @endforeach                              
                                </div>

                                <div class="col-md-12">
                                    <h6><b>Order Total: ₹ @php echo Session::get('cart_total'); @endphp</b></h6>
                                    <p>By placing your order, you agree to BeautifyU's privacy notice and conditions of use.</p>
                                    <input type="submit" class="deliver-btn mb-3 btn-sm" value="Place Your Order" />
                                </div> 

                            </div>
                            
                        @else
                            Cart is Empty
                        @endif

                
                </div>

                <x-checkout-order-summary />

            </div>
        </form>
       
    </div>
</section>

@endsection