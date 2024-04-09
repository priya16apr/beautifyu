<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
       
        <div class="product__item__pic set-bg" 
            @if($product->images) 
                @foreach($product->images as $img)
                    @if ($loop->first)
                    data-setbg="{{ $img->image }}"
                    @endif
                @endforeach
            @endif
        >
            <!-- 
            <div class="label new">New</div>
            <div class="label sale">Sale</div> 
            -->
            <ul class="product__hover">
                <li><a href="
                    @if($product->images) 
                        @foreach($product->images as $img)
                            @if ($loop->first)
                            {{ $img->image }}
                            @endif
                        @endforeach
                    @endif" 
                    class="image-popup"><span class="arrow_expand"></span></a></li>
                <!-- <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                <li><a href="#"><span class="icon_bag_alt"></span></a></li> -->
            </ul>
        </div>

        <div class="product__item__text">
            <h6><a href="{{url('product/'.$product->slug)}}">{{ $product->title }}</a></h6>
            <!-- <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div> -->
            <div class="product__price">
                Rs. {{ $product->selling_price }}
                <span>Rs. {{ $product->mrp_price }}</span>
            </div>
        </div>

    </div>
</div>