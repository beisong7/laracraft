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
                            <li class="active"><a href="#">My Profile</a></li>
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
                   @include('pages.profile.template.sidebar')
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>Profile</h4>

                            </div>

                            @include('layouts.notice')

                            <form class="form" method="get" action="#" >
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Full Name<span></span></label>
                                            <input name="name" type="text" placeholder="Your Name" disabled value="{{ $person->name }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Email<span></span></label>
                                            <input name="email" type="email" placeholder="Your Email" disabled value="{{ $person->email }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Phone<span></span></label>
                                            <input name="phone" type="text" placeholder="Your Phone" disabled value="{{ $person->phone }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date of Birth<span></span></label>
                                            <input name="phone" type="text" placeholder="Your Date of Birth" disabled value="{{ $person->dob }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Address<span></span></label>
                                            <input name="phone" type="text" placeholder="Your Address" disabled value="{{ $person->address }}">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group button">
                                            <a href="#" type="submit" class="btn ">Edit</a>
                                        </div>
                                    </div>

                                    <a href="#" class="m-3 btn btn-outline-dark btn-sm"><i class="fa fa-shield"></i> Change Password</a>
                                    <a href="#" class="m-3 btn btn-outline-danger btn-sm"> <i class="fa fa-user-times"></i> Deactivate Account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    @include('layouts.news_letter_sub')

@endsection
