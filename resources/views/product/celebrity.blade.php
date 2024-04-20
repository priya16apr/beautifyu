@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_celeb_title']}}</title>
    <meta name="description" content="{{$setting['seo_celeb_description']}}">
@endsection

@section('mid-content')

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Celebrity Special</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 col-md-9">
                    <div class="row">
                        @if($product)
                            @foreach($product as $products)
                                <x-product-card :product=$products />
                            @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </section>

@endsection

