<?php
$navlink['cart'] = 'active';
$hide_mini_cart = false;
$title = "Cart";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            @include('layouts.notice')
            <br>
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th>UNIT PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody class="shopping-list">
                        <?php $total = 0; ?>
                        @forelse(!empty($cartItems)?$cartItems:[] as $item)
                            <tr class="cart_item_{{ $item['uuid'] }}">
                                <td class="image" data-title="Image">
                                    <img class="mx-w-100px" src="{{ url($item['img']) }}" alt="#">
                                </td>
                                <td class="thick product-des" data-title="Description">
                                    <p class="product-name" style="color: #333">
                                        {{ $item['name'] }}
                                    </p>
                                </td>
                                <td class="price" data-title="Price">
                                    <b style="color: #333">N{{ number_format(floatval($item['price']), 2) }}</b>
                                </td>
                                <td class="qty" data-title="Qty"><!-- Input Order -->
                                    {{ $item['qty'] }}
                                </td>
                                <td class="total-amount-section thick" data-title="Total"><span class="item_total_price_{{ $item['uuid'] }}">N{{ number_format(floatval($item['total_price']), 2) }}</span></td>
                            </tr>
                            <?php $total += floatval($item['total_price']); ?>
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
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="form-customer form-login" id="cart_submit" action="{{ route('pay') }}" method="post" onsubmit="event.preventDefault(); if($('.total-amount').attr('data-value')>0){$('#cart_submit')[0].submit();}else{alert('Cart Empty')} ">
                        {{ csrf_field() }}
                        <div class="total-amount-section">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    <div class="left">
                                        <div class="buyer mb-2">
                                            <input class="form-element" autocomplete="off" value="{{ $first_name }}" disabled>
                                            <input class="form-element" autocomplete="off" value="{{ $last_name }}" disabled>
                                        </div>
                                        <div class="buyer mb-2">
                                            <input class="form-element" autocomplete="off" value="{{ $phone }}" disabled>
                                            <input class="form-element" autocomplete="off" value="{{ $email }}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-7 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Total Items : <span class="total-count thick">{{ !empty($cartItems)?count($cartItems):0 }} </span></li>
                                            <br>
                                            <li>Cart Subtotal : <span class="total-amount thick" data-value="{{ $total }}">N{{ number_format($total, 2) }}</span></li>

                                        </ul>
                                        <br>
                                        <div class="button5">
                                            <input type="hidden" name="uuid" value="{{ !empty($uuid)?$uuid:'' }}" /> <!-- Local Transaction ID -->
                                            <input type="hidden" name="amount" value="{{ $total }}" /> <!-- Replace the value with your transaction amount -->
                                            <input type="hidden" name="payment_method" value="card" /> <!-- Can be card, account, both -->
                                            <input type="hidden" name="description" value="Purchase {{ !empty($cartItems)?count($cartItems):0 }} Item(s) with {{ env('APP_NAME', '') }} on {{ date('F d, Y') }}." /> <!-- Replace the value with your transaction description -->
                                            <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
                                            <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
                                            <input type="hidden" name="email" value="{{ $email }}" /> <!-- Replace the value with your customer email -->
                                            <input type="hidden" name="firstname" value="{{ $first_name }}" /> <!-- Replace the value with your customer firstname -->
                                            <input type="hidden" name="lastname" value="{{ $last_name }}" /> <!-- Replace the value with your customer lastname -->
                                            <input type="hidden" name="phonenumber" value="{{ $phone }}" /> <!-- Replace the value with your customer phonenumber -->
                                            <button type="submit" class="category-item baby-btn baby-btn-bg no-border">
                                                <b>Pay Now</b> <i class="fa fa-credit-card" style="margin-left: 10px"></i>
                                            </button>
                                            <br>
                                            <br>
                                            <a href="{{ route('view.products') }}" class="zoa-btn btn-login hover-white contact">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        console.log('Callback url')
        console.log('{{ route('callback') }}')
    </script>

@endsection
