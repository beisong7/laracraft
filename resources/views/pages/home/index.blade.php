<?php
//$mainHeader = true;
$navlink['home'] = 'active';
$isHome = true;
?>
@section('page_title', "Home")
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <section>

        @include('pages.home.slider')
        @include('pages.home.trending')
        @include('pages.home.recent')
    </section>


    {{--@include('layouts.banner')--}}

    {{--@include('layouts.products_section')--}}


    {{--@include('pages.home.trash')--}}

    {{--@include('pages.home.blog')--}}

{{--    @include('layouts.news_letter_sub')--}}


@endsection
