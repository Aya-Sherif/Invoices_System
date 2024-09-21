@extends('front.lay')
@include('layouts.message')

@section('content')
    @include('front.about_us')
    {{-- @include('front.portfolio') --}}
    @include('front.blog')
    @include('front.contact')
@endsection
