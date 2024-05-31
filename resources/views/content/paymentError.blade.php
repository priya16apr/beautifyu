@extends('layouts.main')

@section('header-seo')
    <title>Payment Error Page</title>
    <meta name="keywords" content="Payment Error Page">
    <meta name="description" content="Payment Error Page">
@endsection

@section('mid-content')

<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Payment Issue</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-9" style="margin-top:40px;">
                    <div class="row">
                    <p>Your Payment is not completed yet. <br/>
                        If you want to try payment again then. <a href="{{ url('check-out-review') }}">click here</a> </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

