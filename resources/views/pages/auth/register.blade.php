<?php
$navlink['contact_us'] = 'active';
$title = "Register";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-7 col-xs-12 form-ct">
                    <div class="form-main">
                        <div class="title">
                            <h4>Login In</h4>
                            <h3>Sign into your Account</h3>
                        </div>

                        @include('layouts.notice')


                        <form class="form-customer form-login" method="post" action="{{ route('contact.register') }}" onsubmit="">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Full Name<span>*</span></label>
                                        <input name="name" type="text" placeholder="Your Name" required value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input name="email" type="email" placeholder="Your Email" required value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Phone<span>*</span></label>
                                        <input name="phone" type="text" placeholder="Your Phone" required value="{{ old('phone') }}">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group name contact">
                                <input name="password" class="form-control form-account" type="password" placeholder="Password" required>
                                <input name="phone" type="text" placeholder="Your Phone" required value="{{ old('phone') }}">
                            </div>

                            <div class="form-group name contact">
                                <input name="password" class="form-control form-account" type="password" placeholder="Password" required>
                            </div>

                            <div class="form-group name contact">
                                <input name="password2" class="form-control form-account" type="password" placeholder="Confirm Password" required>
                            </div>

                            <div class="btn-button-group mg-top-30 mg-bottom-15 bt-contact">
                                <button type="submit" class="zoa-btn btn-login hover-white contact">Sign Up</button>
                            </div>

                            <b><a href="{{ route('client.login') }}" class="m-3">Already have an account?</a></b>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5 col-xs-12 contact-para">
                    <div class="single-head">
                        <div class="single-info">

                            <h4 class=""><i class="fa fa-phone"></i> Call us Now:</h4>
                            <ul>
                                <li>{{ env('SITE_PHONE', '') }}</li>
                            </ul>
                        </div>
                        <div class="single-info">

                            <h4 class=""><i class="fa fa-envelope-o"></i> Email:</h4>
                            <ul>
                                <li><a href="mailto:{{ env('SITE_EMAIL', '') }}">{{ env('SITE_EMAIL', '') }}</a></li>
                            </ul>
                        </div>
                        <div class="single-info">

                            <h4 class=""><i class="fa fa-location-arrow"></i> Our Address:</h4>
                            <ul>
                                <li>{{ env('SITE_ADR', 'Abuja') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
