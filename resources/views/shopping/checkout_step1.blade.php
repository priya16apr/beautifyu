@extends('layouts.main1')

@section('header-seo')
<title>Cart</title>
<meta name="keywords" content="Cel">
<meta name="description" content="Cel">
@endsection

@section('mid-content')

<section class="checkout spad">
    <div class="container">

        <div class="section-title"><h4>Checkout</h4></div>

        <form name="form2" action="{{route('submit_check_out_step1')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="step-headingss">1. Select a delivery address </div>

                    <div class="row bdr-1 m-3">
                        
                        @if(count($address)>0)      
                                                     
                            @foreach($address as $addresss)
                            <div class="col-md-12">
                                <div class="select-addddres">
                                    <label>
                                        <input type="radio" name="selected_address" id="selected_address" value="{{ $addresss->id }}"
                                        @if ($loop->first) checked  @endif />
                                        &nbsp;
                                        [{{ $addresss->address_type }}]
                                        <b>{{ $addresss->full_name }}</b>, 
                                        {{ $addresss->address_line1 }}, {{ $addresss->address_line2 }}, {{ $addresss->city }}, {{ $addresss->state }}, {{ $addresss->pincode }},
                                        Phone: {{ $addresss->mobile }}
                                    </label>
                                </div>
                            </div>
                            @endforeach 
                        @endif

                        <div class="col-md-12">
                            <div class="p-2">
                                <a href="" data-toggle="modal" data-target="#newaddresss" class="text-13 text-danger">+ Add New Address</a>
                            </div>
                            
                            @if(count($address)>0)  
                                <input type="submit" class="btn-sm btn mb-3 btn-primary" value="use this address" />
                            @endif
                        </div>

                        
                    </div>

                    <div class="step-headingss1">2. Payment Method </div>
                    <div class="step-headingss1">3. Review items and delivery </div>
                </div>

                <x-checkout-order-summary />

            </div>
        </form>
       
    </div>
</section>


<!--------- New Address Popup ------------>
<div class="modal madal-lg fade" id="newaddresss" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form name="form1" action="{{route('submit_addaddress')}}" method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-0">
                    <div class="row p-3">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Pincode <span>*</span></label>
                                    <input type="hidden" name="customerid" id="customerid" value="{{ Session::get('beautify_customer')->id }}" required />
                                    <input type="text" name="add_pincode" id="add_pincode" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Full Name <span>*</span></label>
                                    <input type="text" class="fldone" name="add_name" id="add_name" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" class="fldone" name="add_email" id="add_email" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Address <span>*</span></label>
                                    <input type="text" class="fldone" placeholder="Flat/House No., Street Address" name="add_address1" id="add_address1" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label> &nbsp; <span></span></label>
                                    <input type="text" class="fldone" placeholder="Locality/Landmark" name="add_address2" id="add_address2" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>City <span>*</span></label>
                                    <input type="text" class="fldone" name="add_city" id="add_city" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>State <span>*</span></label>
                                    <input type="text" class="fldone" name="add_state" id="add_state" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Mobile Number <span>*</span></label>
                                    <input type="text" class="fldone" name="add_mobile" id="add_mobile" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <label>Alternate Mobile Number </label>
                                    <input type="text" class="fldone" name="add_alter_mobile" id="add_alter_mobile" />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="checkout__form__input choosee">
                                    <label>Address Type</label>
                                    @if(count($address)>0)
                                        <input type="hidden" name="is_default" value="No" />
                                    @else
                                        <input type="hidden" name="is_default" value="Yes" />
                                    @endif

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Home" checked />
                                        <label class="form-check-label mt-0" for="home">Home/Personal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Office" />
                                        <label class="form-check-label mt-0" for="office">Office/Commercial</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="address_type" id="address_type" value="Other" />
                                        <label class="form-check-label mt-0" for="other">Other</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-sm">Save and Submit</button>
                </div>

            </form> 

        </div>
    </div>
</div>


@endsection