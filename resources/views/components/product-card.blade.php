<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
       
        <div class="product__item__pic set-bg" data-setbg="{{ $product->default_img }}" >
            <!-- 
            <div class="label new">New</div>
            <div class="label sale">Sale</div> 
            -->
            <ul class="product__hover">
                <li><a href="{{ $product->default_img }}" class="image-popup"><span class="arrow_expand"></span></a></li>
            </ul>
        </div>

        <div class="product__item__text">
            <h6><a href="{{url('product/'.$product->slug)}}">{{ $product->title }}</a></h6>
            <div class="product__price">
                Rs. {{ $product->selling_price }}
                <span>Rs. {{ $product->mrp_price }}</span>
            </div>
        </div>

    </div>
</div>