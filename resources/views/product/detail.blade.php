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
                        <span>{{$pdetail->title}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @if($pdetail->images) 
                                @foreach($pdetail->images as $img)
                                    <a class="pt @if ($loop->first) active @endif" href="#product-{{ $img->id }}">
                                        <img src="{{ $img->image }}" />
                                    </a>
                                @endforeach
                            @endif
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @if($pdetail->images) 
                                    @foreach($pdetail->images as $img)
                                        <img data-hash="product-{{ $img->id }}" class="product__big__img" src="{{ $img->image }}" />
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="col-lg-6">
                    <div class="product__details__text">
                       
                        <h3>{{$pdetail->title}} 
                            @if($pdetail->brand)
                            <span>Brand: {{$pdetail->brand->title}} </span>
                            @endif
                        </h3>

                        <!-- <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>( 138 reviews )</span>
                        </div> -->

						<div class="cart__quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
						</div>

                        @if($pdetail->variant)
                            <div class="product__details__price">
                                Rs. {{ $pdetail->variant->selling_price }}
                                <span>Rs. {{ $pdetail->variant->mrp_price }}</span>
                            </div>
                            @if($pdetail->variant->stock>0)
                                <div class="product__details__button">
                                    <a href="#" class="cart-btn">Add to cart</a>
                                    <a href="#" class="buy-btn">Buy Now</a>
                                    <input type="button" name="button1" value="Add to cart" onclick="addCart('{{$pdetail->id}}')" />
                                    <input type="button" name="button1" value="Buy Now" />
                                </div>
                            @else
                                <div class="product__details__button">
                                    <a href="javascript:void();" class="cart-btn">Out of Stock</a>
                                </div>
                            @endif
                        @endif

                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Availability:</span>
                                    <p>In Stock</p>
                                </li>
                                <li>
                                    <span>Delivery:</span>
                                    <p>With in 3-5 working days</p>
                                </li>
                                <li>
                                    <span>Shipping:</span>
                                    <p style="color:#3C6">Free</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Attributes -->
                <div class="col-lg-12">
                    <div class="product__details__tab">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Item Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Ratings & Reviews</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            	<h6>Product Highlights</h6>
                            	<ul class="list-highlights">
                                    {!! $productAttribute !!}
                                </ul>
                                <h6>Description</h6>
                                <p>{!! $pdetail->description !!}</p>
                            </div>

                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Ratings & Reviews</h6>
                                <!-- <p>
                                    <span style="font-size:48px; font-weight:normal; color:#000;">4.1</span>/5 <br />
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span></span>
                                    </div>
                                    <div>Based on 50 Ratings & 2 Reviews</div>
                                </p> -->
                            </div>
                            
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="related__title">
                        <h5>Similar Products</h5>
                    </div>
                </div>

                <div id="recipeCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @if(count($similar)>0)
                            @foreach($similar as $key=>$similars)
                                <div class="carousel-item @if($key=='0') active @endif">
                                    <x-product-card :product=$similars />
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


    <script>
        function addCart(id)
        {
            alert(id)
            
        }
        </script>
@endsection

