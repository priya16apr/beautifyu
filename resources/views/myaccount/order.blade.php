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
                        <span>My Orders</span>
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

                    @if(count($allinfo)>0)                           
                        @foreach($allinfo as $allinfos)
                            @if($allinfos['order'])
                                <div class="col-lg-11 col-md-11 bdr-1 bdr-radius mx-3 mb-4">

                                    <div class="row acc-order-list">
                                        <div class="col-md-3"><span>Order No.</span><br/>BU#{{ $allinfos['order']->id }}</div>
                                        <div class="col-md-3"><span>Order Date</span><br/>{{ date('d M, Y',@strtotime($allinfos['order']->order_date)) }}</div>
                                        <div class="col-md-3"><span>Total Amt</span><br/>Rs {{ $allinfos['order']->total }}</div>
                                        @if($allinfos['order']->orderaddress)
                                            <div class="col-md-3"><span>Ship to</span><br/>
                                                <a href="#" class="tooltip11">{{ $allinfos['order']->orderaddress->full_name }} <i class="fa fa-chevron-down"></i> 
                                                    <span class="tooltiptext">{{ $allinfos['order']->orderaddress->address_line1 }}, {{ $allinfos['order']->orderaddress->address_line2 }},
                                                        {{ $allinfos['order']->orderaddress->city }}, {{ $allinfos['order']->orderaddress->state }}, {{ $allinfos['order']->orderaddress->pincode }}
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="shop__cart__table mb-0">
                                        <table>
                                            <tr>
                                                <td class="cart__product__item">
                                                    <b>Payment Method: {{ $allinfos['order']->payment_method }}</b>
                                                    <p>Package was handed to resident</p>

                                                    @if($allinfos['product'])
                                                        @foreach($allinfos['product'] as $key1=>$products)
                                                            <div class="mb-2">
                                                                <img src="{{ $products->product_image }}" />
                                                                <div class="cart__product__item__title">
                                                                    <h6>
                                                                        <a href="{{ url('product/'.$products->product_link) }}">{{ $products->product_title }}</a> 
                                                                        <span>[Qty: {{ $products->product_qty }}]</span>
                                                                    </h6>
                                                                    <p>Product Price: Rs {{ $products->product_price }}</p>
                                                                    
                                                                    <p class="detail-p-color">
                                                                        Color : <span style="background:{{ $products->product_color }}"></span>
                                                                    </p>

                                                                    <div class="mt-3">
                                                                        <a href="{{ url('product/'.$products->product_link) }}" class="btn btn-warning btn-sm shadow-1">Buy it again</a>
                                                                        <a href="{{ url('product/'.$products->product_link) }}" class="btn btn-light btn-sm shadow-1">View your item</a>
                                                                        <a href="{{ url('product/'.$products->product_link) }}" class="btn btn-light btn-sm shadow-1">Write a product review</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <hr />
                                                        @endforeach
                                                    @endif

                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            @else
                            <div>No Orders are there..</div>
                            @endif
                        @endforeach 
                    @else
                        No Orders are there..
                    @endif
                </div>
            </div>
                
            </div>
        </div>
    </section>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection

