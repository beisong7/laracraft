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
                            <li class=""><a href="{{ route('customer.orders') }}">My Orders <i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Cart Items</a></li>
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
                @include('layouts.notice')
                <div class="row">
                    @include('pages.profile.template.sidebar')
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>Cart Items</h4>
                                <hr>
                            </div>

                            <div class="">

                                <div class="table-responsive-sm">
                                    <!-- Shopping Summery -->
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr class="main-hading">
                                            <th>PRODUCT</th>
                                            <th>NAME</th>
                                            <th class="">UNIT PRICE</th>
                                            <th class="">QUANTITY</th>
                                            <th class="">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody class="shopping-list">
                                        <?php $total = 0; ?>
                                        @forelse($booking->cartItems as $item)
                                            <tr>
                                                <td class="image" data-title="Image"><img style="width: 100px" src="{{ url($item->product->onePic) }}" alt="#"></td>
                                                <td class="product-des" data-title="Description">
                                                    <p class="product-name"><a href="#">{{ $item->name }}</a></p>
                                                    {{--<p class="product-des">{{ $item->product->details }}</p>--}}
                                                </td>
                                                <td class="price" data-title="Price"><span>N{{ number_format(floatval($item['price']), 2) }}</span></td>
                                                <td class="qty" data-title="Qty"><!-- Input Order -->
                                                    <p class="">{{ $item['qty'] }}</p>
                                                    <!--/ End Input Order -->
                                                </td>
                                                <td class="total-amount-section" data-title="Total"><span class="item_total_price_{{ $item['uuid'] }}">N{{ number_format(floatval($item['total_price']), 2) }}</span></td>
                                            </tr>
                                            <?php $total += floatval($item->total_price); ?>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <h6 class="text-muted text-center">No Item In Cart</h6>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <!--/ End Shopping Summery -->
                                </div>

                                <div class="">
                                    <div class="col-12">
                                        <div class="total-amount-section">
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-7 col-12">
                                                    <div class="right">
                                                        <p><b>Total Items</b> <span>{{ $booking->cartItems->count() }}</span></p>
                                                        <p><b>Cart Subtotal</b> <span class="total-amount" data-value="{{ $total }}">N{{ number_format($total, 2) }}</span></p>
                                                        <p><b>Status</b> <span>{{ $booking->handled?'Completed':'Pending' }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    {{--@include('layouts.news_letter_sub')--}}

@endsection
