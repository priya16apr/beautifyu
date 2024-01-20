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
            
                <div class="sidebar__categories">
                    <div class="section-title">
                        <h4>My Account</h4>
                    </div>
                    <div>
                        <x-myaccount-sidebar />
                    </div>
                </div>

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="product__item">
                            My Profile <a href="{{route('myaccount_profile_edit')}}">Edit</a><br/>
                            Name : {{$userinfo->name}}<br/>
                            Email Id : {{$userinfo->email}}<br/>
                            Mobile No : {{$userinfo->mobile}}<br/>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

