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
            
                <x-myaccount-sidebar :userinfo=$userinfo />

                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="acc-heading">Edit Profile</div>
                            <div class="product__item">
                                <form name="form1"  class="prof-list" action="{{route('myaccount_profile_submit')}}" method="post">
                                    @csrf
                                    
                                    <div><span>Full Name :</span> <input type="text" name="name" id="name" value="{{$userinfo->name}}" required /></div>
                                    <div><span>Mobile No :</span> {{$userinfo->mobile}}</div>
                                    <div><span>Email Id :</span> {{$userinfo->email}}</div>
                                    
                                    <div>
                                        <span>Gender :</span>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="male" />
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="female" />
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>

                                    <div>
                                        <span>Date of Birth :</span> 
                                        <input type="date" name="dob" id="dob" />
                                    </div>
                                    
                                    <div>
                                        <span> &nbsp; </span> 
                                        <input type="submit" class="deliver-btn" value="Update Profile" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection

