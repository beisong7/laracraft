<div class="featured-homepage1" style="margin-top: 50px">
    <div class="container">
        <div class="product-related hp1 featured-home1">
            <div class="title-pro-v1 hp1">
                <h3 class="related-title text-center hp1">Latest</h3>

            </div>
            <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate-feat owl-feat-hp1">
                @if(!empty($latest))
                    @foreach($latest as $product)
                        @include('pages.product.single_product2')
                    @endforeach
                @else

                @endif
            </div>
        </div>
    </div>
</div>