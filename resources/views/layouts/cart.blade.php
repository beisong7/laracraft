<div class="date mycart">
    <button class="fa fa-shopping-bag dropdown-toggle" type="button" data-toggle="dropdown">
    </button>
    <div class="dropdown-menu cart2 drop-home-1 check-out-home-1">

        <div class="">
            <span class="cart_item_count" data-value="{{ !empty($cartItems)?count($cartItems):0 }}">{{ !empty($cartItems)?count($cartItems):0 }} Items</span>
        </div>

        <?php $total = 0; ?>

        <div class="cart-2">
            @forelse(!empty($cartItems)?$cartItems:[] as $item)

                <div class="check-out bd-bt cart_item_{{ $item['uuid'] }}" style="margin-bottom: 14px">
                    <div class="img-cart">
                        <a href="#"><img src="{{ url($item['img']) }}" alt="img" style="width: 100%"></a>
                    </div>
                    <div class="para-cart">
                        <br>
                        <p style="margin-top: 5px; margin-bottom: 5px !important;"><a href="#">{{ $item['name'] }}</a></p>
                        <h6 style="display: flex;margin-top: 5px; color: #333; font-size: 14px;" class="thick">
                            {{ $item['qty'] }}pcs : <span class="amount" style="margin-left: 5px"> N{{ number_format($item['total_price'], 2) }}</span>
                            <a href="#" onclick="event.preventDefault(); removeFromCart('{{ route('cart.remove', $item['uuid']) }}', '{{ $item['uuid'] }}')" class="remove" title="Remove this item" style="margin-left: 10px;"><i class="fa fa-trash-o st" aria-hidden="true"></i></a>
                        </h6>

                    </div>
                </div>

                <?php $total += floatval($item['total_price']); ?>
            @empty

            @endforelse

        </div>
        <div>
            <div class="check-out2">
                <div class="total">
                    <p>Total</p>
                    <span class="total-amount" id="total-amount-span" data-value="{{ $total }}">N{{ number_format($total, 2) }}</span>
                </div>
                <div class="check">
                    <a href="{{ route('cart') }}">check out</a>
                </div>
            </div>
        </div>
    </div>

</div>