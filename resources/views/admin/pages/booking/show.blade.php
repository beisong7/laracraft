<?php
 $sidenav['request'] = 'active';
 $title = "Bookings";
?>
@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.layouts.breadcrumb')
        @include('layouts.notice')

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <p>booking from {{ $booking->name }}</p>
                        <h5>Date: <b>{{ date('F d, Y', strtotime($booking->created_at)) }}</b></h5>
                        <p class="text-muted">Product Details</p>
                        <hr>

                        <div class="">

                            <div class="table-responsive-sm">
                                    <!-- Shopping Summery -->
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr class="main-hading">
                                                <th>PRODUCT</th>
                                                <th>NAME</th>
                                                <th class="text-center">UNIT PRICE</th>
                                                <th class="text-center">QUANTITY</th>
                                                <th class="text-center">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody class="shopping-list">
                                        <?php $total = 0; ?>
                                        @forelse($booking->cartItems as $item)
                                            <tr>
                                                <td class="image" data-title="Image"><img style="width: 100px" src="{{ url($item->product->onePic) }}" alt="#"></td>
                                                <td class="product-des" data-title="Description">
                                                    <p class="product-name"><a href="#">{{ $item->name }}</a></p>
                                                    <p class="product-des">{{ $item->product->details }}</p>
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
                                                        <p><b>Ordered By</b> <span>{{ $booking->name }}</span></p>
                                                        <p><b>Phone</b> <span>{{ $booking->phone }}</span></p>
                                                        <p><b>Email</b> <span>{{ $booking->email }}</span></p>
                                                        <p><b>Status</b> <span>{{ $booking->handled?'Completed':'Pending' }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

