<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">

                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="weave" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">

                                    @forelse($products as $product)
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                            @include('pages.product.single_product')
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="p-3"><h5 class="text-muted text-center">No Products Yet</h5></div>
                                        </div>
                                    @endforelse




                                </div>
                            </div>
                        </div>
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->
