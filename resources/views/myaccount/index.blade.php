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
                        <span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop spad">
        <div class="container">
            <div class="row">   
            
                <x-myaccount-sidebar :userinfo=$userinfo />

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="acc-heading">My Profile <span><a href="{{route('myaccount_profile_edit')}}"><i class="fa fa-edit"></i> Edit</a></span></div>
                            <div class="product__item prof-list">
                            <div><span>Name :</span> {{$userinfo->name}}</div>
                            <div><span>Email Id :</span> {{$userinfo->email}}</div>
                            <div><span>Mobile No :</span> {{$userinfo->mobile}}</div>
                            @if($userinfo->gender)<div><span>Gender :</span> {{$userinfo->gender}}</div>@endif
                            @if($userinfo->dob)<div><span>DOB :</span> {{ date('d M, Y',strtotime($userinfo->dob)) }}</div>@endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

