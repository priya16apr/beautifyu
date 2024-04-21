@extends('layouts.main')

@section('header-seo')
    <title>{{$ptype->seo_title}} </title>
    <meta name="description" content="{{$ptype->seo_description}} ">
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
                    
                    <form name="form1" id="form1" method="post" action="{{route('products_ptype_att_search')}}" >
                        @csrf
                        <input type="hidden" name="ptype" id="ptype" value="{{ $ptype['slug'] }}" />

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
                                        @php $sel_coll = "";  @endphp
                                        @if(in_array($side_collections['id'],$leftreq['collection']))
                                           @php $sel_coll = "checked";  @endphp
                                        @endif
                                        <label>
                                            <input type="checkbox" name="collection[]" id="collection" 
                                            value="{{ $side_collections['id']}}" {{ $sel_coll }}
                                            onclick="formSubmit()" /> &nbsp;{{ $side_collections['title']}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Color -->
                        @if(count($side['side_color'])>0)
                            <div class="sidebar__filter">
                                <div class="section-title"><h4>Colors</h4></div>

                                <div class="btn-group color-grop-btt" data-toggle="buttons">
                                    @foreach($side['side_color'] as $side_colors)

                                        @php $sel_col = "";  @endphp

                                        @if(in_array($side_colors['id'],$leftreq['color']))
                                           @php $sel_col = "checked";  @endphp
                                        @endif

                                        @if($side_colors['type']=='Light')
                                           @php $type = "#000";  @endphp
                                        @else
                                           @php $type = "#fff";  @endphp
                                        @endif

                                        <label class="btn" title="{{ $side_colors['name']}}"
                                        style="background:{{ $side_colors['code']}}; color:{{ $type }}" >
                                            <input type="checkbox" name="color[]" id="color" value="{{ $side_colors['id']}}" {{ $sel_col }} autocomplete="off"  />
                                            <span class="fa fa-check"></span>
                                        </label>

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
                                        @php $sel_price = "";                                      
                                            $heading = $side_prices['pricefrom'].'-'.$side_prices['priceto'];
                                        @endphp
                                        @if($heading==$leftreq['price'])
                                           @php $sel_price = "checked";  @endphp
                                        @endif
                                        <label>
                                            <input type="radio" name="price" value="{{ $side_prices['pricefrom']}}-{{ $side_prices['priceto']}}" {{ $sel_price }} />
                                            &nbsp;{{ $side_prices['label']}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <input type="submit" name="submit" class="filter-sub" value="Filter" />
                        <input type="reset" name="clear" class="filter-clr" value="Clear" />

                    </form>

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


@section('footer-js')
<script>
    function formSubmit() 
    { 
        // alert();
        //document.getElementById("form1").form..submit();
        // alert();
        
   };
</script>
@endsection
