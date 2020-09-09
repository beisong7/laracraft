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
                            <li class="active"><a href="#">Password Reset</a></li>
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
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>Password Reset</h4>
                                <h3>Update Account Password</h3>
                            </div>

                            @include('layouts.notice')

                            <form class="form" method="post" action="{{ route('client.reset.pass', $secret) }}" onsubmit="">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Password<span>*</span></label>
                                            <input name="password" type="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Confirm Password<span>*</span></label>
                                            <input name="password2" type="password" placeholder="Confirm Password" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn ">Reset</button>
                                        </div>
                                        <br>
                                        <a href="{{ route('contact.entry') }}" class="">Login</a>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-head">
                            <div class="single-info">
                                <i class="fa fa-phone"></i>
                                <h4 class="title">Call us Now:</h4>
                                <ul>
                                    <li> +234 809 876 5432</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-envelope-open"></i>
                                <h4 class="title">Email:</h4>
                                <ul>
                                    <li><a href="mailto:{{ env('SITE_EMAIL', '') }}.com">{{ env('SITE_EMAIL', '') }}</a></li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-location-arrow"></i>
                                <h4 class="title">Our Address:</h4>
                                <ul>
                                    <li>Tecno Building, Mararaba, Nassarawa state</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    @include('layouts.news_letter_sub')

@endsection
