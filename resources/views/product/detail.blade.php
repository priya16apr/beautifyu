@extends('layouts.main')

@section('header-seo')
    <title>{{$pdetail->seo_title}} </title>
    <meta name="description" content="{{$pdetail->seo_description}} ">
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
                        <form id="form1" novalidate method="post">
                            @csrf
                            <h3>{{$pdetail->title}} 
                                @if($pdetail->brand)
                                <span>Brand: {{$pdetail->brand->title}} </span>
                                @endif
                            </h3>

                            @php 
                            $sale           =   '';
                            $cartinfo       =   "";
                            $deal_status    =   $pdetail->deal_status;

                            if($deal_status=='Deal')
                            {
                                $date               =   date('Y-m-d');
                                
                                $deal_start_date    =   $pdetail->deal_start_date;
                                $deal_end_date      =   $pdetail->deal_end_date;

                                if(($deal_start_date==$date || $deal_start_date<$date) && ($deal_end_date==$date || $deal_end_date>$date))
                                {
                                    $sale               =   "Yes"; 
                                    $cartinfo           =   "Deal: $deal_start_date to $deal_end_date @ Discount: Rs $pdetail->deal_discount @ Old Selling Price: $pdetail->selling_price  @ New Selling Price: $pdetail->deal_selling_price";
                                }  
                            }

                            @endphp

                            <!-- Rating Component -->
                            <x-product-rating :product=$pdetail label="yes" />

                            <!-- <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 reviews )</span>
                            </div> -->

                            <div class="detail-p-color">
                                @if($pdetail->color) Color :   
                                    <span style="background:{{ $pdetail->color->code }}" title="{{ $pdetail->color->name }}"></span>
                                @endif   
                            </div>
                            
                            <div class="cart__quantity">
                                <div class="form-group row">
                                    <label class="col-form-label" for="product_qty">Quantity</label>
                                    <select name="product_qty" id="product_qty" class="sel-quant">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>

                                    <input type="hidden" name="product_id" id="product_id" value="{{$pdetail->id}}" />
                                    <input type="hidden" name="product_name" id="product_name" value="{{$pdetail->title}}" />
                                    <input type="hidden" name="product_mrp" id="product_mrp" value="{{$pdetail->mrp_price}}" />
                                    <input type="hidden" name="product_color" id="product_color" value="@if($pdetail->color){{$pdetail->color->code}}@endif" />
                                    
                                    @if(count($pdetail->images)>0)  
                                        <input type="hidden" name="product_image" id="product_image" value="{{$pdetail->images[0]->image}}" />
                                    @endif
                                    <input type="hidden" name="product_link" id="product_link" value="{{$pdetail->slug}}" />
                                </div>
                            </div>

                            @if($sale=='Yes')
                                
                                <input type="hidden" name="product_price" id="product_price" value="{{$pdetail->deal_selling_price}}" />
                                <input type="hidden" name="cart_info" id="cart_info" value="@php echo $cartinfo; @endphp" />
                                <div class="badge badge-danger">Special discount ₹ {{ $pdetail->deal_discount }}</div>
                                <div class="product__details__price">
                                    @php echo "₹ ".$pdetail->deal_selling_price;  @endphp
                                    <span>₹ {{ $pdetail->mrp_price }}</span>
                                </div>

                            @else
                                
                                <input type="hidden" name="product_price" id="product_price" value="{{$pdetail->selling_price}}" />
                                <input type="hidden" name="cart_info" id="cart_info" value="" />
                                <div class="product__details__price">
                                    <span class="sign">₹</span> {{ $pdetail->selling_price }}
                                    <span>₹ {{ $pdetail->mrp_price }}</span>
                                </div>

                            @endif

                            @if($pdetail->stock>0)
                                <div class="product__details__button">
                                    @if($cart=='exist')
                                        <a href="{{url('shopping-cart')}}" class="cart-btn">Already in Cart</a>
                                    @else
                                        <input type="button" class="cart-btn" name="button1" id="button1" value="Add to cart" onclick="addCart('{{$pdetail->id}}','cart')" />
                                        <input type="button" class="buy-btn" name="button2" id="button2" value="Buy Now" onclick="addCart('{{$pdetail->id}}','checkout')" />
                                    @endif
                                </div>
                            @else
                                <div class="product__details__button">
                                    <a href="javascript:void();" class="cart-btn">Out of Stock</a>
                                </div>
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
                        </form>
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
                                <!-- <div class="row">
                                    <div class="col-md-5">
                                    <h6>Ratings & Reviews</h6>
                                    
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
                                        <hr>
                                        <div class="bg-light p-3">
                                        <h6>Review this product</h6>
                                        <p>Share your thoughts with our customers</p>
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#writerevieww">Write a product review</button>
                                        </div>
                                    
                                    </div>

                                    <div class="col-md-7">
                                    <h6>Customer Reviews</h6>
                                        @foreach($rating as $rate)

                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span></span>
                                            </div>
                                            <p>{{ $rate->message }}</p>
                                            <p><b>{{ $rate->name }}</b></p>
                                            <hr>

                                        @endforeach

                                    </div>
                                </div> -->
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

    <!-- Model -->
    <div class="modal madal-lg fade" id="writerevieww" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2"><img src="{{ $img->image }}"></div>
                    <div class="col-md-10">Alloy Multi Color Traditional Necklaces Set Choker</div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"> &nbsp;</div>
                            <div class="col-md-8">
                                <div class="rating">
                                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </div>
                                </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Add a headline</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Write a review</label>
                        <div class="col-sm-8">
                        <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm">Submit Review</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        function addCart(id,pagename)
        {
            var userinfo = "{{ Session::get('beautify_customer') }}";
            
            //jQuery('.product__details__button').html("<a href='/shopping-cart' class='buy-btn'>Added in Cart</a>");

            jQuery('#button1').attr('disabled', true);
            jQuery('#button2').attr('disabled', true);

            jQuery.ajax({
                url:"/ajax/submit-addcart",
                type:'POST',
                data:$('#form1').serialize(),
                success:function(data)
                {
                    var datas = data.split('***');

                    if(datas[0]=='added')
                    {
                        if(pagename=='checkout')
                        {
                            // First Check Login
                            if(userinfo)
                            {
                                window.location.href = '/check-out-address-select';
                            }
                            else
                            {
                                window.location.href = '/user-login?handle=beautifyu_checkout_in';
                            }
                        }
                        else
                        {
                            window.location.href = '/shopping-cart';
                        }
                    }
                    else
                    {
                        jQuery("#msz").html(datas[0]);
                    }
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection

