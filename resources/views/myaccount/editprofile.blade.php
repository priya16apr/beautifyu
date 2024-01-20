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
                        <a href="{{route('myaccount')}}">My Account</a>
                        <span>Edit Profile</span>
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
                        <h4>Edit Profile</h4>
                    </div>
                    <div>
                        <x-myaccount-sidebar />
                    </div>
                </div>

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="product__item">


                            <form name="form1" action="{{route('myaccount_profile_submit')}}" method="post">
                                @csrf
                                Name : <input type="text" name="name" id="name" value="{{$userinfo->name}}" required /><br/>
                                Email Id : {{$userinfo->email}}<br/>
                                Mobile No : {{$userinfo->mobile}}<br/>
                                <input type="submit" value="Update" />
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

