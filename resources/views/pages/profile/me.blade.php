<?php
$navlink['contact_us'] = 'active';
$title = $person->first_name;
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')


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

                            <form class="form-customer form-login" method="get" action="#" >
                                <div class="form-group ">
                                    <label>Full Name<span></span></label>
                                    <input class="form-control form-account" name="name" type="text" placeholder="Your Name" disabled value="{{ $person->name }}">
                                </div>
                                <div class="form-group ">
                                    <label>Email<span></span></label>
                                    <input class="form-control form-account" name="email" type="email" placeholder="Your Email" disabled value="{{ $person->email }}">
                                </div>
                                <div class="form-group ">
                                    <label>Phone<span></span></label>
                                    <input class="form-control form-account" name="phone" type="text" placeholder="Your Phone" disabled value="{{ $person->phone }}">
                                </div>
                                <div class="form-group ">
                                    <label>Date of Birth<span></span></label>
                                    <input class="form-control form-account" name="phone" type="text" placeholder="Your Date of Birth" disabled value="{{ $person->dob }}">
                                </div>
                                <div class="form-group ">
                                    <label>Address<span></span></label>
                                    <input class="form-control form-account" name="phone" type="text" placeholder="Your Address" disabled value="{{ $person->address }}">
                                </div>
                                <br>
                                <div class="">
                                    <div class="form-group button">
                                        <a href="#" type="submit" class="baby-btn baby-btn-bg ">Edit <i class="fa fa-edit"></i></a>
                                    </div>
                                </div>


                                <br>
                                <br>

                                <a href="#" class="m-3 btn btn-warning btn-sm"><i class="fa fa-shield"></i> Change Password</a>
                                <a href="#" class="m-3 btn btn-danger btn-sm"> <i class="fa fa-user-times"></i> Deactivate Account</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->


@endsection
