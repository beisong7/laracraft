<?php
$navlink['contact_us'] = 'active';
$title = "My Account";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                @include('layouts.notice')
                <div class="row">
                   @include('pages.profile.template.sidebar')
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>Activity Overview</h4>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12 mag-3">
                                    <div class="bg-card shadow" style="position:relative;">
                                        <div class="">
                                            <h4 style="">Orders</h4>
                                            <h1>{{ $person->orders->count() }}</h1>
                                        </div>
                                        <b><a class="float-right" href="{{ route('customer.orders') }}">View</a></b>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mag-3">
                                    <div class="bg-card shadow" style="position:relative;">
                                        <div class="">
                                            <h4 style="">Reviews</h4>
                                            <h1>{{ $person->reviews->count() }}</h1>
                                        </div>
                                        <b><a class="float-right" href="{{ route('customer.reviews') }}">View</a></b>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mag-3">
                                    <div class="bg-card shadow" style="position:relative;">
                                        <div class="">
                                            <h4 style="">Wish List</h4>
                                            <h1>{{ $person->wishlist->count() }}</h1>
                                        </div>
                                        <b><a class="float-right" href="{{ route('customer.wishList') }}">View</a></b>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 mag-3">
                                    <div class="bg-card shadow" style="position:relative;">
                                        <div class="">
                                            <h4 style="">Payments</h4>
                                            <h1>{{ $person->payments->count() }}</h1>
                                        </div>
                                        <b><a class="float-right" href="{{ route('customer.payList') }}">View</a></b>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    {{--@include('layouts.news_letter_sub')--}}

@endsection
