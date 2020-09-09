<?php
$navlink['contact_us'] = 'active';
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')


    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">My Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

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

                            <div class="">

                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                       <div class="p-4 shadow-sm d-card">
                                           <div class="row">
                                               <div class="col">
                                                   <h6>Orders</h6>
                                                   <a href="{{ route('customer.orders') }}">View</a>
                                               </div>
                                               <div class="col">
                                                   <h3>{{ $person->orders->count() }}</h3>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="p-4 shadow-sm d-card">
                                            <div class="row">
                                                <div class="col">
                                                    <h6>Reviews</h6>
                                                    <a href="{{ route('customer.reviews') }}">View</a>
                                                </div>
                                                <div class="col">
                                                    <h3>{{ $person->reviews->count() }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="p-4 shadow-sm d-card">
                                            <div class="row">
                                                <div class="col">
                                                    <h6>Wish List</h6>
                                                    <a href="{{ route('customer.wishList') }}">View</a>
                                                </div>
                                                <div class="col">
                                                    <h3>{{ $person->wishlist->count() }}</h3>
                                                </div>
                                            </div>
                                        </div>
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
