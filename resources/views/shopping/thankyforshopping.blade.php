@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_thankyou_title']}}</title>
    <meta name="description" content="{{$setting['seo_thankyou_description']}}">
@endsection

@section('mid-content')

    <section class="shop-cart spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="cart__btn">
                    <div class="row ">
                        <div class="col-12 col-sm-12 text-center">
                               <h4>Thank You for Shopping with us.</h4>
                                <p class="mt-3">Order Id: <u>#BU{{ $detail->id }}</u></p>
                                Your order details and product info has been sent to your registered email id.
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </section>

@endsection

