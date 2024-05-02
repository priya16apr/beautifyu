<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
       
        @php 
        $sale           =   '';
        $deal_status    =   $product->deal_status;

        if($deal_status=='Deal')
        {
            $date               =   date('Y-m-d');
            
            $deal_start_date    =   $product->deal_start_date;
            $deal_end_date      =   $product->deal_end_date;

            if(($deal_start_date==$date || $deal_start_date<$date) && ($deal_end_date==$date || $deal_end_date>$date))
            {
                $sprice             =   $product->deal_selling_price;
                $sale               =   "Yes"; 
            }  
            else
            {
                $sprice             =   $product->selling_price;
            }
        }
        else
        {
            $sprice                 =   $product->selling_price;
        }
        @endphp
    
    
        <div class="product__item__pic set-bg" data-setbg="{{ $product->default_img }}" >
            @if($sale=='Yes') <div class="label sale">Deal of the Day</div> @endif
            <ul class="product__hover">
                <li><a href="{{ $product->default_img }}" class="image-popup"><span class="arrow_expand"></span></a></li>
            </ul>
        </div>

        <div class="product__item__text">
            <h6><a href="{{url('product/'.$product->slug)}}">{{ $product->title }}</a></h6>
            
            <!-- Rating Component -->
            <x-product-rating :product=$product label="no" />

            @if($sale=='Yes')
            
                <div class="badge badge-danger">Special discount ₹ {{ $product->deal_discount }}</div>
                <div class="product__price">
                    @php echo "Rs. ".$sprice;  @endphp
                    <span>Rs. {{ $product->mrp_price }}</span>
                </div>

            @else

                <div class="product__price">
                    Rs. {{ $product->selling_price }}
                    <span>Rs. {{ $product->mrp_price }}</span>
                </div>

            @endif
        </div>

    </div>
</div>