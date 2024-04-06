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
                        <span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                
            
            <div class="sidebar__categories">
                <div class="section-title">
                    <h4>My Account</h4>
                </div>
                <div>
                    <x-myaccount-sidebar />
                </div>
            </div>

            <div class="col-lg-9 col-md-9">
                <div class="row">

                    <div class="col-md-12">
                        <div class="bdr-1 p-4">
                            <h5>Order No: BU#{{ $detail->id }}</h5>
                            <p>Order Date: {{ $detail->order_date }}</p>
                            @if($detail->orderaddress)
                            <p>Address: {{ $detail->orderaddress->full_name }}, {{ $detail->orderaddress->full_name }}, 
                                {{ $detail->orderaddress->address_line1 }}, {{ $detail->orderaddress->address_line2 }},
                                {{ $detail->orderaddress->city }}, {{ $detail->orderaddress->state }}, {{ $detail->orderaddress->pincode }} 
                            </p>
                            @endif
                            <p>Payment Method: {{ $detail->payment_method }}<br/>
                            Total Amount: {{ $detail->total }}</p> 
                        </div>

                        @if(count($product)>0)                           
                            @foreach($product as $products)
                            <div class="col-md-12">
                                <div class="bdr-1 p-4">
                                    <h5>Title: <a href="{{ url('product/'.$products->product_link) }}">{{ $products->product_title }}</a></h5>
                                    <p>Image: <a href="{{ url('product/'.$products->product_link) }}"><img src="{{ $products->product_image }}" height="150" /></a></p>
                                    <div class="d-flex">{{ $products->product_price }}</div>
                                    <div class="d-flex">{{ $products->product_qty }}</div>
                                    <div class="d-flex">{{ $products->sub_total }}</div>
                                </div>
                            </div>
                            @endforeach 
                        @endif

                    </div>

                </div>
            </div>
                
            </div>
        </div>
    </section>


@endsection

