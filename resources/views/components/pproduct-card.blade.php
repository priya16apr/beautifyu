<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
        
        <div class="product__item__pic set-bg" data-setbg="">

            @if($product->images) 
                @foreach($product->images as $img)
                    @if ($loop->first)
                        <img src="{{ $img->image }}" />
                    @endif
                @endforeach
            @endif
            <!-- <div class="label stockout">out of stock</div> -->
            <!-- <div class="label sale">Sale</div> -->
            <!-- <div class="label new">New</div> -->

            <ul class="product__hover">
                <li><a href="img/product/product-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
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
                @if($product->variant) ₹ {{ $product->variant->selling_price }} @endif
                @if($product->variant) <span>₹ {{ $product->variant->mrp_price }}</span> @endif
            </div>
        </div>

    </div>
</div>