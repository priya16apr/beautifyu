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
                    @if(count($order)>0)                           
                        @foreach($order as $orders)
                            <div class="col-lg-11 col-md-11 bdr-1 bdr-radius mx-3 mb-4">

                                <div class="row acc-order-list">
                                    <div class="col-md-3"><span>Order No.</span><br/>BU#{{ $orders->id }}</div>
                                    <div class="col-md-3"><span>Order Date</span><br/>{{ $orders->order_date }}</div>
                                    <div class="col-md-3"><span>Total Amt</span><br/>Rs {{ $orders->total }}</div>
                                    @if($orders->orderaddress)
                                        <div class="col-md-3"><span>Ship to</span><br/>
                                            <a href="#" class="tooltip11">{{ $orders->orderaddress->full_name }} <i class="fa fa-chevron-down"></i> 
                                                <span class="tooltiptext">{{ $orders->orderaddress->address_line1 }}, {{ $orders->orderaddress->address_line2 }},
                                                    {{ $orders->orderaddress->city }}, {{ $orders->orderaddress->state }}, {{ $orders->orderaddress->pincode }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- <div class="shop__cart__table mb-0">
                                    <table>
                                        <tr>
                                            <td class="cart__product__item">
                                                <b>Payment Method: {{ $orders->payment_method }}</b>
                                                <p>
                                                Package was handed to resident
                                                </p>

                                                <div class="mb-2">
                                                    <img src="http://seller.beautifyu.in/uploads/VGtDVOTTlT.jpg" />
                                                    <div class="cart__product__item__title">
                                                        <h6><a href="">Round Kundan Pendant Set with Beads Mala</a> <span>[Qty: 1]</span></h6>
                                                        <p>Payment Method: {{ $orders->payment_method }} | Product Price: 199</p>
                                                        <div class="mt-3">
                                                            <a href="" class="btn btn-warning btn-sm shadow-1">Buy it again</a>
                                                            <a href="" class="btn btn-light btn-sm shadow-1">View your item</a>
                                                            <a href="" class="btn btn-light btn-sm shadow-1">Write a product review</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="mb-2">
                                                    <img src="http://seller.beautifyu.in/uploads/VGtDVOTTlT.jpg" />
                                                    <div class="cart__product__item__title">
                                                        <h6><a href="">Round Kundan Pendant Set with Beads Mala</a> <span>[Qty: 1]</span></h6>
                                                        <p>Payment Method: {{ $orders->payment_method }} | Product Price: 199</p>
                                                        <div class="mt-3">
                                                            <a href="" class="btn btn-warning btn-sm shadow-1">Buy it again</a>
                                                            <a href="" class="btn btn-light btn-sm shadow-1">View your item</a>
                                                            <a href="" class="btn btn-light btn-sm shadow-1">Write a product review</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>


                                    </table>
                                </div> -->

                            </div>
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

