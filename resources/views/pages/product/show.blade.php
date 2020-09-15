<?php
$navlink['product'] = 'active';
$title = "Products ";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <section>
        <div class="product-v1 pro-v4">
            <div class="container">
                <div class="menu-prv1">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="">/</a></li>
                        <li><a href="{{ route('view.products') }}">Shop Products</a></li>
                        <li><a href="">/</a></li>
                        <li><a href="#">{{ $product->name }}</a></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 pro-v4">
                        <div class="product-img-slide pro-v4">
                            <div class="product-images quickview">
                                <div class="main-img js-product-slider-normal">

                                    @foreach($product->uploads as $image)
                                        <a href="#" class="hover-images effect"><img src="{{ $image->photo() }}" alt="photo" class="img-responsive"></a>
                                    @endforeach


                                </div>
                            </div>
                            <div class="multiple-img-list js-click-product-normal">
                                @foreach($product->uploads as $image)
                                    <div class="product-col">
                                        <div class="img pro-v4 ">
                                            <img src="{{ $image->photo() }}" alt="photo" class="img-responsive">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="product-info s8 pro-v1 pro-v4">
                            <div class="sale-para2 shop-1 pro-v1 shop-5 shop-6 shop-7 shop-8 pro-v1">
                                <p><a href="#">{{ $product->name }}</a></p>
                                <ul>
                                    <li><span>{{ $product->reviews->count() }} Review(s)</span></li>
                                    <li><a class="sales-36-products" href="#">N{{ number_format($product->price, 2) }}</a></li>
                                </ul>
                            </div>
                            <div class="short-desc">
                                <p class="product-desc s8 pro-v1 pro-v4">
                                    {!! $product->details !!}
                                </p>
                            </div>
                            @if($product->colors->count() > 0)
                                <div class="color pr1 pro-v4">
                                    <h4>Color</h4>
                                    <ul>
                                        <li><a href=""><img src="images/elip1.png" alt=""></a></li>
                                        <li><a href=""><img src="images/elip2.png" alt=""></a></li>
                                        <li><a href=""><img src="images/elip3.png" alt=""></a></li>
                                        <li><a href=""><img src="images/elip4.png" alt=""></a></li>
                                        <li><a href=""><img src="images/elip5.png" alt=""></a></li>
                                    </ul>
                                </div>
                            @endif

                            @if($product->sizes->count() > 0)
                                <div class="size shop5 pro-1 pro-v4" style="display: block">
                                    <h4>Size</h4>
                                    <ul>
                                        @foreach($product->sizes as $size)
                                            <li class=""><a class="" href="#">{{ $size->info->measure }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="zoa-qtt pro-v1">
                                <button type="button" class="quantity-left-minus btn btn-number js-minus" data-type="minus" data-field="">
                                </button>
                                <input type="text" name="number" value="1" class="input-number product_quantity_number js-number" id="singleOrderVal">
                                <button type="button" class="quantity-right-plus btn btn-number js-plus" data-type="plus" data-field="">
                                </button>
                            </div>

                            <a href="#" style="margin-left: 10px; margin-right: 10px;" class=" btn btn_{{ $product->uuid }} thick category-item baby-btn baby-btn-bg" onclick="event.preventDefault(); addValToCart('{{ route('cart.add', $product->uuid) }}', 'btn_{{ $product->uuid }}')">
                                Add To Cart
                            </a>
                            <div title="Add to Wish list" class="product-bottom-group shop7 s8 pro-v1 pro-v2 text-center">
                                <a href="#" class="fa fa-heart shop7">
                                    <span class="zoa-icon-cart shop7"></span>
                                </a>
                            </div>

                            <br>
                            <br>

                            <div class="share-shop7 s8">
                                <ul>
                                    <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- details -->
        <div class="container">
            <div class="single-product-tab bd-bottom">
                <ul class="tabs text-center">
                    <li class="active"><a data-toggle="pill" href="#add">Reviews(s)</a></li>
                </ul>
                <div class="tab-content">
                    <div id="add" class="tab-pane fade in active">
                        @forelse($product->reviewed as $review)
                            <div class="para-pro-v1">
                                <div class="single-rating">
                                    <div class="rating-author">
                                        <img src="{{ url('img/user.png') }}" alt="#">
                                    </div>
                                    <div class="rating-des">
                                        <h6>{{ $review->name }}</h6>
                                        <span class="text-muted"><i>{{ date('F d, Y', $review->time) }}</i></span>
                                        <p>{{ $review->info }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="para-pro-v1">
                                <p>Be the first to review “{{ env('APP_NAME', '') }}” <br>
                                    <span>The email address will not be published. Required fields are marked*</span>
                                </p>
                            </div>
                        @endforelse

                        <div class="form-v4 pro-v1">
                            <?php
                            $randa = random_int(0, 6);
                            $randb = random_int(4, 9);
                            $summed = $randa + $randb;
                            ?>
                            <form method="post" class="form-customer form-login" action="{{ route('review.product', $product->uuid) }}">
                                {{ csrf_field() }}
                                <div class="form-group review">
                                    <p>Your review*</p>
                                    <p>Your email address will not be published. Required fields are marked</p>
                                    <input type="text" name="info" class="form-control form-account">
                                </div>
                                @auth("customer")
                                    <div class=" form-group name pro-v1">

                                        <p>Name*</p>
                                        <input type="hidden" class="form-control form-account"  name="name" required="required" value="{{ $person->name }}" readonly>
                                    </div>
                                    <div class="form-group email pro-v1">

                                        <p>Email address*</p>
                                        <input type="hidden" class="form-control form-account" name="email" required="required" value="{{ $person->email }}" readonly="">
                                    </div>

                                @else
                                    <div class=" form-group name pro-v1">
                                        <p>Name*</p>
                                        <input type="text" class="form-control form-account" name="name" required="required" >
                                    </div>
                                    <div class="form-group email pro-v1">
                                        <p>Email address*</p>
                                        <input type="email" class="form-control form-account" name="email" required="required" >
                                    </div>
                                    <div class="form-group email pro-v1" style="margin-left: 10px">
                                        <p>Verify ( {{ $randa ." + ".$randb }} = ? ) * </p>
                                        <input type="text" class="form-control form-account" placeholder="Your Answer" autocomplete="off" name="verify" required="required" >
                                    </div>
                                @endauth

                                <div class="btn-button-group mg-top-30 mg-bottom-15">
                                    <button type="submit" class="zoa-btn btn-login hover-white">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="product-related pd-products">
                <div class="title-pro-v1">
                    <h3 class="related-title text-center">Related Products</h3>
                    <p><a href="{{ route('view.products') }}">View All Products<i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                </div>
                <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate" style="padding: 10px">

                    @forelse($product->related() as $product)
                        @include('pages.product.single_product2')
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- End Most Popular Area -->
@endsection