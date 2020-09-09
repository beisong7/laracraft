<?php
$navlink['contact_us'] = 'active';
$title = "Contact";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <!-- Start Contact -->

    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 contact-para">
                    <div class="logo-para contact">
                        <p>If you would like to discuss your requirements, or indeed would like<br>
                            us to assist defining the requirements of your website users then<br>
                            please contact us.
                        </p>
                    </div>
                    <div class="icon-para contact">
                        <ul>
                            <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>Telephone: {{ env('SITE_PHONE','') }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>Email: {{ env('SITE_EMAIL','') }}</a></li>
                        </ul>
                    </div>
                    <div class="bytheme contact">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook ct" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12 form-ct">
                    <div class="form-v4 contact">
                        @include('layouts.notice')

                        <?php
                        $randa = random_int(0, 6);
                        $randb = random_int(4, 9);
                        $summed = $randa + $randb;
                        ?>

                        <form method="post" class="form-customer form-login" action="{{ route('contact.submit') }}">
                            {{ csrf_field() }}
                            <input type="hidden" class="" value="{{ encrypt($summed) }}" name="summed">

                            <div class="form-group name contact">
                                <input type="text" name="name" class="form-control form-account" placeholder="Name *" required>
                            </div>
                            <div class="form-group email">
                                <input type="email" name="email" class="form-control form-account" placeholder="Email address *" required>
                            </div>

                            <div class="form-group name contact">
                                <input type="text" name="subject" class="form-control form-account" placeholder="Subject *" required>
                            </div>
                            <div class="form-group email">
                                <input type="text" name="phone" class="form-control form-account" placeholder="Your Phone *" required>
                            </div>

                            <div class="form-group name contact">
                                <input type="text" name="subject" class="form-control form-account" placeholder="Verify {{ $randa ." + ".$randb }} = ?  *" required>
                            </div>


                            <div class="form-group review contact">

                                <input type="text" name="message" class="form-control form-account" placeholder="Your Messenger*">
                            </div>
                            <div class="btn-button-group mg-top-30 mg-bottom-15 bt-contact">
                                <button type="submit" class="zoa-btn btn-login hover-white contact">Send a messenger</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Contact -->


@endsection
