<?php
$navlink['cart'] = 'active';
$hide_mini_cart = true;
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Booking</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            @include('layouts.notice')
            <br>
            @include('pages.cart.book_table')
        </div>
    </div>

    @include('layouts.news_letter_sub')

@endsection
