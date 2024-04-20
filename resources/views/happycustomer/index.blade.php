@extends('layouts.main')

@section('header-seo')
    <title>{{$setting['seo_hcustomer_title']}}</title>
    <meta name="description" content="{{$setting['seo_hcustomer_description']}}">
@endsection


@section('mid-content')

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

