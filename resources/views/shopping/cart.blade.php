@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_cart_title']}}</title>
    <meta name="description" content="{{$setting['seo_cart_description']}}">
@endsection

@section('mid-content')

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop-cart spad">
        <div class="container">
            @if(count($cart)>0)
                <span id="msz"></span>
            
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shop__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php $total=0; @endphp
                                    @foreach($cart as $carts)
                                        <tr>
                                            <td class="cart__product__item">
                                                <img src="{{ $carts->product_image }}" alt="{{ $carts->product_name }}">
                                                <div class="cart__product__item__title">
                                                    <h6><a href="{{url('product/'.$carts->product_link)}}">{{ $carts->product_name }}</a></h6>
                                                </div>
                                            </td>
                                            <td class="cart__price">Rs. {{ $carts->product_price }}</td>
                                            <td class="cart__price">
                                                <button onclick="decreaseQuantity('{{ $carts->id }}')">-</button>
                                                <input type="text" value="{{ $carts->product_qty }}" size="3" readonly />
                                                <button onclick="increaseQuantity('{{ $carts->id }}')">+</button>
                                            </td>
                                            <td class="cart__price">Rs. {{ $carts->sub_total }}</td>
                                            <td class="cart__close"><a href="javascript:void()" 
                                            onclick="deleteProduct('{{ $carts->id }}')"><span class="icon_close"></span></a></td>
                                        </tr>
                                    @endforeach                              

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__total__procced">
                            <ul>
                                <li>Subtotal <span>Rs. {{ Session::get('cart_total') }}</span></li>
                                <li>Shipping Charges <span>Free </span></li>
                                <li>Total <span class="price-finall">Rs. {{ Session::get('cart_total') }}</span></li>
                            </ul>
                            
                            @if(session('beautify_customer'))
                                <a href="{{url('check-out')}}" class="primary-btn">Proceed to checkout</a>
                            @else
                                <a href="{{url('user-login?p=shop')}}" class="primary-btn">Proceed to checkout</a>
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

</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

