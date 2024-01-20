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
                @if(count($order)>0)                           
                    @foreach($order as $orders)
                    <div class="col-md-4">
                        <div class="bdr-1 p-4">
                            <h5>Order No: BU#{{ $orders->id }}</h5>
                            <p>Order Date: {{ $orders->order_date }}</p>
                            @if($orders->orderaddress)
                            <p>Address: {{ $orders->orderaddress->full_name }}, {{ $orders->orderaddress->full_name }}, 
                                {{ $orders->orderaddress->address_line1 }}, {{ $orders->orderaddress->address_line2 }},
                                {{ $orders->orderaddress->city }}, {{ $orders->orderaddress->state }}, {{ $orders->orderaddress->pincode }} 
                            </p>
                            @endif
                            <p>Payment Method: {{ $orders->payment_method }}<br/>
                            Total Amount: {{ $orders->total }}</p>
                            
                            <!-- <hr />
                            <div class="d-flex">
                                <a href="" class="ms-auto text-dark text-13">Detail</a>
                            </div> -->
                        </div>
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


@endsection

