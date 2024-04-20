@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_thankyou_title']}}</title>
    <meta name="description" content="{{$setting['seo_thankyou_description']}}">
@endsection

@section('mid-content')

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Thank You</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop-cart spad">
        <div class="container">
 
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="cart__btn">
                    <div class="row ">
                        <div class="col-12 col-sm-12">
                                Thank You for Shopping with us.<br/>
                                Order: <u>#BU{{ $detail->id }}</u><br/>
                                Your order details and product info has been sent to your registered email id.
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </section>

@endsection

