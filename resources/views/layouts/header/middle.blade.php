<div class="header-center-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 header">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ url('images/logo.png') }}" alt="logo" style="max-height: 50px"></a>
                </div>
            </div>
            @auth("customer")
            <div class="col-md-3 col-sm-12 col-xs-12 logo">
                <div class="date2">
                    <div class="date">
                        <a href="{{ route('customer.account') }}"><i class="fa fa-user st-calendar" aria-hidden="true"></i></a>
                    </div>
                    <div class="para-a">
                        <h4><a href="{{ route('customer.account') }}">My Account</a></h4>
                        <p class="mb-0">{{ $person->first_name }}</p>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 hd-right">
                <div class="date4">
                    <div class="date">
                        <a href="{{ route('customer.logout') }}"><i class="fa fa-power-off st-phone" aria-hidden="true"></i></a>
                    </div>
                    <div class="para-a a3">
                        <h4><a href="{{ route('customer.logout') }}">Log out</a></h4>
                        <p class="mb-0">Sign me out</p>

                    </div>
                </div>
            </div>
            @else
                <div class="col-md-3 col-sm-12 col-xs-12 logo">
                    <div class="date2">
                        <div class="date">
                            <a href="{{ route('contact.entry') }}"><i class="fa fa-sign-in st-calendar" aria-hidden="true"></i></a>
                        </div>
                        <div class="para-a">
                            <h4><a href="{{ route('contact.entry') }}">Login</a></h4>
                            <p class="mb-0">Login to your account</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 logo">
                    <div class="date2">
                        <div class="date">
                            <a href="{{ route('contact.signup') }}"><i class="fa fa-sign-in st-calendar" aria-hidden="true"></i></a>
                        </div>
                        <div class="para-a">
                            <h4><a href="{{ route('contact.signup') }}">Sign Up</a></h4>
                            <p class="mb-0">Register your account</p>

                        </div>
                    </div>
                </div>
            @endguest




        </div>
    </div>
</div>