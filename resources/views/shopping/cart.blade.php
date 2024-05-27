@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_cart_title']}}</title>
    <meta name="description" content="{{$setting['seo_cart_description']}}">
@endsection

@section('mid-content')

    <section class="shop-cart spad">
        <div class="container">
            @if(count($cart)>0)
                <span id="msz"></span>
            
                <div class="row">
                    <div class="col-lg-8">

                        <div class="section-title">
                            <h4>Shopping Cart</h4>
                        </div>

                        @php $total=0; @endphp
                        @foreach($cart as $carts)
                        <div class="row cart-bag-page">
                            <div class="col-md-9">
                                <div class="cart-bag-img">
                                    <img src="{{ $carts->product_image }}" alt="{{ $carts->product_name }}">
                                </div>
                                <a href="{{url('product/'.$carts->product_link)}}">{{ $carts->product_name }}</a>
                                                            
                                <div class="mt-2">
                                    <div class="col p-0">
                                        <x-product-rating :product="$carts->product" label="no" />
                                    </div>
                                    <div class="col">
                                        <div class="detail-p-color">
                                            Color : <span style="background:{{ $carts->product_color }}"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="cart__quantity">
                                    <div class="form-group row mb-0">
                                    <label class="col-form-label m-0" for="product_qty">Qty</label>
                                        <select name="product_qty" id="product_qty" onchange="updateQuantity('{{ $carts->id }}',this.value)" class="sel-quant">
                                            <option value="1" @if($carts->product_qty=='1') selected @endif >1</option>
                                            <option value="2" @if($carts->product_qty=='2') selected @endif >2</option>
                                            <option value="3" @if($carts->product_qty=='3') selected @endif >3</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3 text-right">
                                <div class="product__details__price">
                                    <span class="sign">₹</span> {{ $carts->product_price }} <br />
                                    <span>MRP.: ₹ {{ $carts->product_mrp }}</span>
                                </div>
                                <a class="text-13" href="javascript:void()" onclick="deleteProduct('{{ $carts->id }}')">Remove</a>
                            </div>
                        </div>
                        @endforeach

                        <div class="text-right">Subtotal ({{$count_cart}} items): ₹ <b>{{ Session::get('cart_total') }}</b></div>

                    </div>

                    <div class="col-lg-4">
                        <div class="cart__total__procced">
                            <ul>
                                <li>Items <span>{{$count_cart}} </span></li>
                                <li>Subtotal <span>₹ {{ Session::get('cart_total') }}</span></li>
                                <li>Shipping Charges <span>Free </span></li>
                                <li>Total <span class="price-finall">₹ <b>{{ Session::get('cart_total') }}</b></span></li>
                            </ul>
                            
                            @if(session('beautify_customer'))
                                <a href="{{route('check_out_step1')}}" class="primary-btn">Proceed to buy</a>
                            @else
                                <a href="{{url('user-login?handle=beautifyu_checkout_in')}}" class="primary-btn">Proceed to buy</a>
                            @endif
                            
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn">
                            <a href="/">Continue Shopping</a>
      
                            <a  href="javascript:void();" onclick="empty()">Shopping Cart Empty</a>
                        </div>
                    </div>
                    
                </div>
            @else
                Cart is Empty
            @endif
            
        </div>
    </section>

@endsection

<script>

    function increaseQuantity(cartid)
    {
        jQuery.ajax({
            url:"/ajax/cart-increaseQuantity",
            data:"cartid="+cartid,
            type:'GET',
            success:function(data)
            {
                if(data=='updated')
                {
                    window.location.href = '/shopping-cart';
                }
                else
                {
                    jQuery("#msz").html(data);
                }
            }
        });
    }

    function decreaseQuantity(cartid)
    {
        jQuery.ajax({
            url:"/ajax/cart-decreaseQuantity",
            data:"cartid="+cartid,
            type:'GET',
            success:function(data)
            {
                window.location.href = '/shopping-cart';
                
                // if(data=='updated')
                // {
                //     window.location.href = '/shopping-cart';
                // }
                // else
                // {
                //     //jQuery("#msz").html(data);
                // }
            }
        });
    }

    function updateQuantity(cartid,qty)
    {
        jQuery.ajax({
            url:"/ajax/cart-updateQuantity",
            data:"cartid="+cartid+"&qty="+qty,
            type:'GET',
            success:function(data)
            {
                if(data=='updated')
                {
                    window.location.href = '/shopping-cart';
                }
                else
                {
                    jQuery("#msz").html(data);
                }
            }
        });
    }

    function deleteProduct(cartid)
    {
        var x = confirm("Are you sure you want to delete this item.");
        if (x)
        {
            jQuery.ajax({
                url:"/ajax/cart-deleteProduct",
                data:"cartid="+cartid,
                type:'GET',
                success:function(data)
                {
                    window.location.href = '/shopping-cart';
                }
            });
        } 
        else
        {
            return false;  
        }
            
        
        
    }

    function empty()
    {
        jQuery.ajax({
            url:"/ajax/cart-empty",
            type:'GET',
            success:function(data)
            {
                window.location.href = '/shopping-cart';
            }
        });
    }

    function apply_coupon()
    {
        coupon_code = jQuery('#coupon_code').val();

        if(coupon_code=='')
        {
            alert("please enter copuon code first.")
        }
        else
        {
            jQuery.ajax({
                url:"/ajax/cart-applyCoupon",
                data:"coupon_code="+coupon_code,
                type:'POST',
                success:function(data)
                {
                    alert(data);
                }
            });
        }
    }

</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

