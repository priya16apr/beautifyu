@extends('layouts.main')

@section('header-seo')
    <title>{{$content->seo_title}}</title>
    <meta name="keywords" content="{{$content->seo_keyword}}">
    <meta name="description" content="{{$content->seo_description}}">
@endsection

@section('mid-content')
<div class="container cont-pagess">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="cont-pagess">
                <div class="section-title">
                    <h4>{{$content->title}}</h4>
                </div>
                <div class="content-detailsss">
                    {!!$content->description!!}
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

