@extends('layouts.main')

@section('header-seo')
    <title>{{$content->seo_title}}</title>
    <meta name="keywords" content="{{$content->seo_keyword}}">
    <meta name="description" content="{{$content->seo_description}}">
@endsection

@section('mid-content')

    {{$content->title}}
    <br/>
    {!!$content->description!!}

@endsection

