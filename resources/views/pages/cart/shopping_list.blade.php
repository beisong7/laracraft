<?php $total = 0; ?>
<ul class="shopping-list">
    @forelse(!empty($cartItems)?$cartItems:[] as $item)
        <li class="cart_item_{{ $item['uuid'] }}">
            <a href="#" onclick="event.preventDefault(); removeFromCart('{{ route('cart.remove', $item['uuid']) }}', '{{ $item['uuid'] }}')" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
            <a class="cart-img" href="#"><img src="{{ url($item['img']) }}" alt="#"></a>
            <h4><a href="#">{{ $item['name'] }}</a></h4>
            <p class="quantity">{{ $item['qty'] }}x  - <span class="amount">N{{ $item['total_price'] }}</span></p>
        </li>
        <?php $total += floatval($item['total_price']); ?>
    @empty

    @endforelse

</ul>
<div class="bottom">
    <div class="total">
        <span>Total</span>
        <span class="total-amount" id="total-amount-span" data-value="{{ $total }}">N{{ number_format($total, 2) }}</span>
    </div>

    <a href="#" class="btn animate">Order</a>
</div>