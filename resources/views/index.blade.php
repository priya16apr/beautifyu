@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_home_title']}}</title>
    <meta name="description" content="{{$setting['seo_home_description']}}">
@endsection

@section('mid-content')
   
    <!-- Banner -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6 p-0">
                    @if(count($topbanner)>0)
                        @foreach($topbanner as $key=>$topbanners)
                            @if($key=='0')
                            <div class="categories__item categories__large__item set-bg"
                                data-setbg="{{$topbanners->image}}">
                                <div class="categories__text">                                    
                                    <h1>{{$topbanners->title}}</h1>
                                    <p>{{$topbanners->subtitle}}</p>
                                    @if($topbanners->link)
                                        <a target="_blank" href="{{$topbanners->link}}">Shop now</a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        @if(count($topbanner)>0)
                            @foreach($topbanner as $key=>$topbanners)
                                @if($key!='0')
                                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                    <div class="categories__item set-bg" data-setbg="{{$topbanners->image}}">
                                        <div class="categories__text">
                                            <h4>{{$topbanners->title}}</h4>
                                            <p>{{$topbanners->subtitle}}</p>
                                            @if($topbanners->link)
                                                <a target="_blank" href="{{$topbanners->link}}">Shop now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- USP -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                @if(count($usp)>0)
                    @foreach($usp as $key=>$usps)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="services__item">
                                <span><img src="{{$usps->icon}}" /></span>
                                <h6>{{$usps->title}}</h6>
                                <p>{{$usps->subtitle}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Latest Arrivals -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Latest Arrivals</h4>
                    </div>
                </div>
            </div>
            <div class="row property__gallery">
                @if(count($p_arrival)>0)
                    @foreach($p_arrival as $key=>$p_arrivals)
                        <x-product-card :product=$p_arrivals />
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Top Trending -->
    <section>
        <div class="container">
            <div class="row" style="width:100%; display:block;">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h4>Top Trending Products</h4>
                    </div>
                </div>
                <div id="recipeCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @if(count($p_trending)>0)
                            @foreach($p_trending as $key=>$p_trendings)
                                <div class="carousel-item @if($key=='0') active @endif">
                                    <x-product-card :product=$p_trendings />
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev bg-dark w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next bg-dark w-auto" href="#recipeCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Special -->
    <section class="mb-5">
        <div class="container">
            <div class="row">
                
                <div class="col-md-4 col-sm-12">
                    <div class="bdr-1 p-3 boxes-col">
                        <div class="section-title"><h4>Celebrity Special</h4><span><a href="{{ route('products_celebrity') }}">See all</a></span></div>
                        <div class="row">
                            @if(count($p_celeb)>0)
                                @foreach($p_celeb as $key=>$p_celebs)
                                    <div class="col-md-6 p-0">
                                        <div class="special-4box">
                                            <a href="{{ url('/product/'.$p_celebs->slug) }}"><img src="{{$p_celebs->default_img}}" alt="" />
                                                <h6>{{$p_celebs->title}}</h6>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="bdr-1 p-3 boxes-col">
                        <div class="section-title"><h4>Combo Special</h4><span><a href="/products/combos">See all</a></span></div>
                        <div class="row">
                            @if(count($p_combo)>0)
                                @foreach($p_combo as $key=>$p_combos)
                                    <div class="col-md-6 p-0">
                                        <div class="special-4box">
                                            <a href="{{ url('/product/'.$p_combos->slug) }}"><img src="{{$p_combos->default_img}}" alt="" />
                                                <h6>{{$p_combos->title}}</h6>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="bdr-1 p-3 boxes-col">
                        <div class="section-title"><h4>Deals of the Day</h4><span><a href="{{ route('products_deal') }}">See all</a></span></div>
                        <div class="row">
                            @if(count($p_deal)>0)
                                @foreach($p_deal as $key=>$p_deals)
                                    <div class="col-md-6 p-0">
                                        <div class="special-4box">
                                            <a href="{{ url('/product/'.$p_deals->slug) }}"><img src="{{$p_deals->default_img}}" alt="" />
                                                <h6>{{$p_deals->title}}</h6>
                                            </a>
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

    <!-- Happy Customers -->
    <section>
        <div class="instagram">
            <div class="container-fluid">
                <h3>Our Happy Customers</h3><br />
                <div class="row">
                    @if(count($hcustomer)>0)
                        @foreach($hcustomer as $key=>$hcustomers)
                            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                                <div class="instagram__item set-bg" data-setbg="{{$hcustomers->image}}">
                                    <div class="instagram__text">
                                        <img src="{{$hcustomers->product->default_img}}">
                                        <p>Rs. {{$hcustomers->product->selling_price}}</p>
                                        <a href="product/{{$hcustomers->product->slug}}">View product</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

