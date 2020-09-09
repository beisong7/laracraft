<div class="col-lg-3 col-md-3 col-12 mobile-nav">
    <div class="single-head">
        <div class="single-info">
            <div class="mobile-img">
                <img src="{{ $person->image }}" alt="" class="" width="100%" style="width: 100%">
            </div>
            <h5 class="title text-center mt-3">{{ $person->name }}</h5>
            <ul>
                <li> <p class="text-center">{{ $person->phone }}</p></li>
                <li> <p class="text-center">{{ $person->email }}</p></li>
            </ul>
        </div>
        <div class="single-info">
            <ul>
                <li class="mb-3 "> <a href="{{ route('customer.account') }}">Dashboard</a></li>
                <li class="mb-3 "> <a href="{{ route('customer.profile') }}">My Profile</a></li>
                <li class="mb-3 "> <a href="{{ route('customer.orders') }}">My Orders</a></li>
                <li class="mb-3 "> <a href="{{ route('customer.wishList') }}">My Wish List</a></li>
                <li class="mb-3 "> <a href="#">Reviews</a></li>
            </ul>

        </div>
        <div class="single-info">
            <i class="fa fa-power-off"></i>
            <ul>
                <li><a href="{{ route('customer.logout') }}">Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>