<div class="featured-homepage1">
    <div class="container">
        <div class="product-related hp1 featured-home1">
            <div class="title-pro-v1 hp1">
                <h3 class="related-title text-center hp1">Trending</h3>

            </div>
            @if(!empty($trends))
                <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate-feat owl-feat-hp1">
                    @foreach($trends as $product)
                        @include('pages.product.single_product2')
                    @endforeach
                </div>
            @else

            @endif
        </div>
    </div>
</div>