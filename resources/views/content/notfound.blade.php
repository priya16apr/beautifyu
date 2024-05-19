@extends('layouts.main')

@section('header-seo')
    <title>404 Not Found</title>
    <meta name="keywords" content="404 Not Found">
    <meta name="description" content="404 Not Found">
@endsection

@section('mid-content')

<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Not Found page</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                            Data is Not Found...
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

