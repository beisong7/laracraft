<!-- Start Footer Area -->
<footer>
    <div class="footers " style="margin-top: 100px">
        <div class="container">
            <div class="one">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="logo-para">
                            <a href="#"><img src="{{ url('images/logo.png') }}" alt="logo"></a>
                        </div>
                        <div class="icon-para">
                            <ul>
                                <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>Telephone: {{ env('SITE_PHONE', '') }}</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>Email: {{ env('SITE_EMAIL', '') }}</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>Address: {{ env('SITE_ADR', '') }}</a></li>

                            </ul>
                        </div>
                        <div class="bytheme">

                            <div class="icons-ft">
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-vine" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- footer-left -->
                    <div class="col-md-6 col-sm-6 col-xs-12 fix ">
                        <div class="ft-center">
                            <div class="information">
                                <h4>Useful Links</h4>
                                <div class="border2"></div>
                                <a href="{{ route('see.page', 'about-us') }}">About Us</a>
                                <br>
                                <a href="{{ route('see.page', 'f-a-q') }}">Faq</a>
                                <br>
                                <a href="{{ route('see.page', 'terms-and-conditions') }}">Terms & Conditions</a>
                                <br>
                                <a href="{{ route('contact-us') }}">Contact Us</a>
                                <br>

                            </div>
                            <div class="information center">
                                <h4>
                                    <span style="color: white">I</span>
                                </h4>
                                <div class="border2"></div>
                                <a href="{{ route('see.page', 'payment-methods') }}">Payment Methods</a>
                                <br>
                                <a href="{{ route('see.page', 'returns-policy') }}">Returns Policy</a>
                                <br>
                                <a href="{{ route('see.page', 'delivery-information') }}">Delivery Information</a>
                                <br>
                                <a href="{{ route('see.page', 'privacy-policy') }}">Privacy Policy</a>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!-- footer center -->

                </div>
            </div>
            <div class="border"></div>
        </div>
    </div>

    <!-- footer-ending -->
    <div class="footerending">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="fted-left">
                        <p>Copyright © 2018 by </p>
                        <a href="{{ route('home') }}">{{ env('APP_NAME', '') }}. </a>
                        <span>All Rights Reserved.</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<a href="#" class="zoa-btn scroll_top"><i class="ion-ios-arrow-up"></i></a>