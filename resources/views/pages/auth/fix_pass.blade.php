<?php
$navlink['contact_us'] = 'active';
$title = "Password Reset";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-5 col-xs-12 contact-para">
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
                <div class="col-md-8 col-sm-7 col-xs-12 form-ct">

                    <div class="form-main">
                        <div class="title">
                            <h4>Password Reset</h4>
                            <h3>Update Account Password</h3>
                        </div>

                        @include('layouts.notice')

                        <form class="form-customer form-login" method="post" action="{{ route('client.reset.pass', $secret) }}" onsubmit="">
                            {{ csrf_field() }}

                            <div class="form-group name contact">
                                <label>Password<span>*</span></label>
                                <input name="password" type="password" class="form-control form-account" placeholder="Password" required>
                            </div>

                            <div class="form-group name contact">
                                <label>Confirm Password<span>*</span></label>
                                <input name="password2" type="password" class="form-control form-account" placeholder="Confirm Password" required>
                            </div>

                            <div class="btn-button-group mg-top-30 mg-bottom-15 bt-contact">
                                <button type="submit" class="zoa-btn btn-login hover-white contact">Reset</button>
                            </div>

                            <br>

                            <b><a href="{{ route('contact.entry') }}" class="m-3">Login</a></b>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

@endsection
