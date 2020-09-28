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
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="shopping-list">
                        <?php $total = 0; ?>
                        @forelse(!empty($cartItems)?$cartItems:[] as $item)
                            <tr class="cart_item_{{ $item['uuid'] }}">
                                <td class="image" data-title="Image"><a href="{{ route('preview.product', $item['uuid']) }}"><img class="mx-w-100px" src="{{ url($item['img']) }}" alt="#"></a></td>
                                <td class="thick product-des" data-title="Description">
                                    <p class="product-name"><a href="{{ route('preview.product', $item['uuid']) }}">{{ $item['name'] }}</a></p>
                                    <p class="product-des">{{ $item['details'] }}</p>
                                </td>
                                <td class="price" data-title="Price">
                                    <b style="color: #333">N{{ number_format(floatval($item['price']), 2) }}</b>
                                </td>
                                <td class="qty" data-title="Qty"><!-- Input Order -->
                                    <div class="input-group flexed">
                                        <a href="javascript:void(0)" type="button" class="btn btn-default" onclick="updateQty('{{ route('cart.qty.update', [$item['uuid'], 'minus']) }}')">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <input type="text" class="w-50px form-element mb-0 input-number item_qty_{{ $item['uuid'] }}"  data-min="1" value="{{ $item['qty'] }}">
                                        <a href="javascript:void(0)" type="button" class="btn btn-default" onclick="updateQty('{{ route('cart.qty.update', [$item['uuid'], 'plus']) }}')">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <!--/ End Input Order -->
                                </td>
                                <td class="total-amount-section thick" data-title="Total"><span class="item_total_price_{{ $item['uuid'] }}">N{{ number_format(floatval($item['total_price']), 2) }}</span></td>
                                <td class="action" data-title="Remove"><a href="#" onclick="event.preventDefault(); removeFromCart('{{ route('cart.remove', $item['uuid']) }}', '{{ $item['uuid'] }}')" class="category-item baby-btn baby-btn-bg"><i class="fa fa-trash" style="font-size: 16px"></i></a></td>
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
                    <form class="form-customer form-login" id="cart_submit" action="{{ route('shopping.order') }}" method="post" onsubmit="event.preventDefault(); if($('.total-amount').attr('data-value')>0){$('#cart_submit')[0].submit();}else{alert('Cart Empty')} ">
                        {{ csrf_field() }}
                        <div class="total-amount-section">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    @auth("customer")
                                    <div class="left">
                                        <div class="">
                                            <input name="full_name" class="form-element" placeholder="Full Name (required)" required autocomplete="off" value="{{ $person->name }}" readonly="readonly">
                                        </div>
                                        <div class="buyer mb-2">
                                            <input name="phone" placeholder="Phone (required)" class="form-element" required autocomplete="off" value="{{ $person->phone }}" readonly="readonly">
                                        </div>
                                        <div class="buyer mb-2">
                                            <input name="phone" class="form-element" onkeypress="return isNumberKey(event);" placeholder="Phone (required)" required autocomplete="off" value="{{ $person->phone }}" readonly="readonly">
                                            <input name="email" type="email" class="form-element" placeholder="Email (important)" autocomplete="off" value="{{ $person->email }}" readonly="readonly">

                                        </div>

                                    </div>

                                    @else
                                        <div class="left">
                                            <div class="buyer mb-2">
                                                <input name="first_name" class="form-element" placeholder="First Name (required)" required autocomplete="off">
                                                <input name="last_name" class="form-element" placeholder="Last Name (required)" required autocomplete="off">
                                            </div>
                                            <div class="buyer mb-2">
                                                <input name="phone" class="form-element" onkeypress="return isNumberKey(event);" placeholder="Phone (required)" required autocomplete="off">
                                                <input name="email" class="form-element" type="email" placeholder="Email (important)" autocomplete="off">
                                            </div>
                                        </div>
                                    @endguest

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
                                            <button type="submit" class="category-item baby-btn baby-btn-bg no-border">
                                                <b>Complete Order</b>
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

@endsection
