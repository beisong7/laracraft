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
            </tr>
            </thead>
            <tbody class="shopping-list">
            <?php $total = 0; ?>
            @forelse($booking->cartItems as $item)
                <tr>
                    <td class="image" data-title="Image"><img src="{{ url($item->product->getpic1()) }}" alt="#"></td>
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
</div>
<div class="row">
    <div class="col-12">
        <div class="total-amount-section">
            <div class="row">
                <div class="col-lg-8 col-md-5 col-12">

                </div>
                <div class="col-lg-4 col-md-7 col-12">
                    <div class="right">
                        <ul>
                            <li>Total Items <span>{{ $booking->cartItems->count() }}</span></li>
                            <li>Cart Subtotal<span class="total-amount" data-value="{{ $total }}">N{{ number_format($total, 2) }}</span></li>
                            <li>Ordered By <span>{{ $booking->name }}</span></li>
                            <li>Phone <span>{{ $booking->phone }}</span></li>
                            <li>Email <span>{{ $booking->email }}</span></li>
                            <li><b>Status</b> <span>{{ $booking->handled?'Completed':'Pending' }}</span></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>