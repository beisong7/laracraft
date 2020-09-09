<div class="" style="margin-bottom: 20px">
    <div class="product-img product-item shop5 ">
        <a href="{{ route('preview.product', $product->uuid) }}">
            <img class="img-responsive default-img load_image" data-img_link="{{ url($product->onePic) }}"  src="{{ url("template/blur.jpg") }}" alt="#">
        </a>

        @if($product->isNew)
            <div class="sale-img shop1 shop2">
                <div class="before shop1 v2"></div>
            </div>
            <div class="ribbon zoa-hot shop-v1"><span>New</span></div>
        @endif
        <div class="product-button-group product-details">
            <a href="{{ route('preview.product', $product->uuid) }}" class="zoa-btn zoa-quickview">
                <span class="fa fa-eye"></span>
            </a>

            @auth("customer")
            <a title="Wishlist" href="#" onclick="event.preventDefault(); addToWish('{{ route('customer.addToWish', $product->uuid) }}','_sw_{{ $product->uuid }}')"  class="zoa-btn zoa-wishlist">
                <span class="fa fa-heart "></span>
            </a>
            @else
                <a href="{{ route('contact.entry') }}" class="zoa-btn zoa-wishlist">
                    <span class="fa fa-heart "></span>
                </a>
                @endguest

                <a title="Add to cart" href="#" onclick="event.preventDefault(); addToCart('{{ route('cart.add', $product->uuid) }}', 'btn_{{ $product->uuid }}')" class="btn_{{ $product->uuid }} zoa-btn zoa-addcart">
                    <span class="fa fa-shopping-bag"></span>
                </a>
        </div>

    </div>
    <div class="sale-para2 shop-1 pro-v1 shop-5 shop-6">
        <p><a href="#">{{ $product->name }}</a></p>
        <ul>
            <li><small class="text-muted">{{ $product->reviews->count() }} Review(s)</small></li>
            <li><a class="sales-36" href="#">N{{ number_format($product->price, 2) }}</a></li>

        </ul>
    </div>
</div>