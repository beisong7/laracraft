<!-- Start Shop Blog  -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img class="load_image" data-img_link="{{ url($blog->banner()) }}" src="{{ url("template/blur.jpg") }}" alt="#">
                        <div class="content">
                            <p class="date">{{ date('F d, Y', strtotime($blog->created_at)) }}</p>
                            <a href="{{ route('blog.view', $blog->slug) }}" class="title">{{ $blog->title }}</a>
                            <a href="{{ route('blog.view', $blog->slug) }}" class="more-btn">Continue Reading</a>
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
            @empty
                <div class="col-12">
                    <h5 class="text-center">No publication available at the moment. check back later</h5>
                </div>
            @endforelse


        </div>
    </div>
</section>
<!-- End Shop Blog  -->