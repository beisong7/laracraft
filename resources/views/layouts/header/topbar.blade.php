<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <!-- Top Left -->
                <div class="top-left">
                    <ul class="list-main">
                        <li><i class="ti-headphone-alt"></i> +234 809 876 5432</li>
                        <li><i class="ti-email"></i> {{ env('SITE_EMAIL', '') }}</li>
                    </ul>
                </div>
                <!--/ End Top Left -->
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <!-- Top Right -->
                <div class="right-content">
                    <ul class="list-main">

                        @auth("customer")

                            <li><i class="ti-user"></i> <a href="{{ route('customer.account') }}">My account</a></li>
                            <li><i class="ti-power-off"></i> <a href="{{ route('customer.logout') }}">Sign Out</a></li>
                        @else
                            <li><i class="ti-power-off"></i><a href="{{ route('contact.entry') }}">Login</a></li>
                            <li><i class="ti-user"></i><a href="{{ route('contact.signup') }}">Register</a></li>
                        @endguest
                            <li><i class="ti-files"></i><a href="{{ route('blog') }}">Blog</a></li>
                            <li><i class="ti-map"></i><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
                <!-- End Top Right -->
            </div>
        </div>
    </div>
</div>