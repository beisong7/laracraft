<div class="single-product">
    <div class="product-img">
        <a href="{{ route('preview.product', $product->uuid) }}">

            <?php $i=0; ?>
            @foreach($product->twoImage as $image)
                @if($i===0)
                    <img class="default-img load_image" data-img_link="{{ url($image->photo()) }}"  src="{{ url("template/blur.jpg") }}" alt="#">
                @else
                    <img class="hover-img load_image" data-img_link="{{ url($image->photo()) }}"  src="{{ url("template/blur.jpg") }}" alt="#">
                @endif
                <?php $i+=1; ?>
            @endforeach

        </a>
        <div class="button-head">
            <div class="product-action">

                {{--<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Preview</span></a>--}}
                @auth("customer")
                    <a title="Wishlist" href="#" onclick="event.preventDefault(); addToWish('{{ route('customer.addToWish', $product->uuid) }}','_sw_{{ $product->uuid }}')" class=" mr-3">
                        <i class=" ti-heart "></i><span class="_sw_{{ $product->uuid }}">Add to Wishlist</span>
                    </a>
                @else
                    <a title="Wishlist" href="{{ route('contact.entry') }}" class="mr-3"><i class=" ti-heart "></i><span>Login</span></a>
                @endguest
            </div>
            <div class="product-action-2">
                <a title="Add to cart" href="#" onclick="event.preventDefault(); addToCart('{{ route('cart.add', $product->uuid) }}', 'btn_{{ $product->uuid }}')" class="btn_{{ $product->uuid }}">
                    <i class="fa fa-cart-plus ml-3"></i> Add to cart
                </a>
            </div>
        </div>
    </div>
    <a href="{{ route('preview.product', $product->uuid) }}">
        <div class="product-content">
            <p style="color: inherit">{{ $product->name }}</p>
            <div class="product-price">
                <span>N{{ number_format($product->price, 2) }}</span>
            </div>
        </div>
    </a>

</div>