<div class="col-lg-3 col-md-3 col-12 mobile-nav">
    <div class="single-head card shadow">
        <div class="p-5" style="padding: 15px">
            <div class="single-info">
                <div class="mobile-img">
                    <img src="{{ $person->image }}" alt="" class="" width="50%" style="width: 50%">
                </div>
                <h5 class="mt-3">{{ $person->name }}</h5>
                <p style="color: #333">{{ $person->phone }}</p>
                <p style="color: #333">{{ $person->email }}</p>

            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="card shadow">
        <div class="p-5" style="padding: 15px">
            <div class="single-info">
                <a class="btn btn-dark btn-block btn-custom" href="{{ route('customer.account') }}">Dashboard</a>
                <a class="btn btn-dark btn-block btn-custom" href="{{ route('customer.profile') }}">My Profile</a>
                <a class="btn btn-dark btn-block btn-custom" href="{{ route('customer.orders') }}">My Orders</a>
                <a class="btn btn-dark btn-block btn-custom" href="{{ route('customer.wishList') }}">My Wish List</a>
                <a class="btn btn-dark btn-block btn-custom" href="{{ route('customer.reviews') }}">Reviews</a>
                <br>
                <a class="btn btn-block btn-unique" href="{{ route('customer.logout') }}">Sign Out <i class="fa fa-power-off ml-2"></i></a>
            </div>
        </div>
    </div>
</div>