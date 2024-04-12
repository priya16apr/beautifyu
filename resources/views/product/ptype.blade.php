@extends('layouts.main')

@section('header-seo')
    <title>Cel</title>
    <meta name="keywords" content="Cel">
    <meta name="description" content="Cel">
@endsection

@section('mid-content')

<style>
    .section-title{margin-bottom:30px !important;}
</style>

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>{{ $ptype['title'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">

                <!-- Side Bar -->              
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">

                        <!-- Category -->
                        <div class="sidebar__categories">
                            <div class="section-title"><h4>Categories</h4></div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    {{getSideBarHierarchy()}}
                                </div>
                            </div>
                        </div>

                        <!-- Collection -->
                        @if(count($side['side_collection'])>0)
                            <div class="sidebar__categories">
                                <div class="section-title"><h4>Collections</h4></div>
                                <div>
                                    @foreach($side['side_collection'] as $side_collections)
                                        <input type="checkbox" name="input_collection" id="input_collection" value="{{ $side_collections['id']}}" /> &nbsp;{{ $side_collections['title']}}<br/>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Color -->
                        @if(count($side['side_color'])>0)
                            <div class="sidebar__filter">
                                <div class="section-title"><h4>Colors</h4></div>
                                <div>
                                    @foreach($side['side_color'] as $side_colors)
                                        <input type="checkbox" name="input_collection" id="input_collection" value="{{ $side_colors['id']}}" /> &nbsp;{{ $side_colors['name']}}<br/>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Price Range -->
                        @if(count($side['side_price'])>0)
                            <div class="sidebar__filter">
                                <div class="section-title"><h4>Price Range</h4></div>
                                <div>
                                    @foreach($side['side_price'] as $side_prices)
                                        <a href="">&nbsp;{{ $side_prices['label']}}</a><br/>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Custom -->
                        @if($side['side_custom'])
                            @foreach($side['side_custom'] as $side_customs)
                                <div class="sidebar__categories">
                                    <div class="section-title"><h4>{{$side_customs['label']}}</h4></div>
                                    <div>
                                    @if($side_customs['col'])
                                        @foreach($side_customs['col'] as $side_customs_cols)
                                            <input type="checkbox" name="input_custom" id="input_custom" value="{{ $side_customs_cols['id']}}" /> &nbsp;{{ $side_customs_cols['value']}}<br/>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <!-- Show Prodcuts -->
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @if($product)
                            @foreach($product as $products)
                                <x-product-card :product=$products  />
                            @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </section>

@endsection

