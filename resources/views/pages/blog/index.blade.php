<?php
$navlink['blog'] = 'active';
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')


    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Blogs {{ !empty($extra)?"($extra)":'' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Single -->
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">

                        @forelse($blogs as $blog)
                            <div class="col-lg-6 col-md-6 col-12 shadow-sm">
                                <!-- Start Single Blog  -->
                                <div class="shop-single-blog">
                                    <img src="{{ url($blog->banner()) }}" alt="#">
                                    <div class="content">
                                        <p class="date">{{ date('F d, Y', strtotime($blog->created_at)) }}</p>
                                        <a href="{{ route('blog.view', $blog->slug) }}" class="title">{{ $blog->title }}</a>
                                        <p class="text-muted mb-0"><small class="">{{ $blog->desc }}</small></p>
                                        <a href="{{ route('blog.view', $blog->slug) }}" class="more-btn">Read More...</a>
                                    </div>
                                </div>
                                <!-- End Single Blog  -->
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="p-3">
                                    <h5 class="text-center">No Publications at the moment. check back later</h5>
                                </div>
                            </div>
                        @endforelse


                        <div class="col-12">
                            @if(!empty($paginated))
                                {{ $blogs->links() }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget search">
                            <div class="form">
                                <input type="email" placeholder="Search Here...">
                                <a class="button" href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Blog Categories</h3>
                            <ul class="categor-list">
                                @forelse($contents as $content)
                                    <li><a href="#">{{ $content->name }}</a></li>
                                @empty
                                    <li><a href="#">No Categories found.</a></li>
                                @endforelse

                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Recent post</h3>
                            @forelse($recents as $recent)
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{ url($recent->banner) }}" alt="#">
                                    </div>
                                    <div class="content">
                                        <h5><a href="{{ route('blog.view', $recent->slug) }}">{{ $recent->title }}</a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{ date('F d, Y', strtotime($recent->created_at)) }}</li>
                                            {{--<li><i class="fa fa-commenting-o" aria-hidden="true"></i>35</li>--}}
                                        </ul>
                                    </div>
                                </div>
                            @empty
                                <h5 class="text-center text-muted">No Recent Post</h5>
                            @endforelse


                        </div>

                        <div class="single-widget newsletter">
                            <h3 class="title">Newslatter</h3>
                            <div class="letter-inner">
                                <h4>Subscribe & get news <br> latest updates.</h4>
                                <form action="#" onsubmit="event.preventDefault(); subscribe_me()">
                                    <div class="form-inner">
                                        <input id="news_email" name="EMAIL" style="padding: 0 10px" placeholder="Your email address" required type="email" autocomplete="off">
                                        <button class="btn btn-block mt-3" type="submit">Subscribe</button>
                                    </div>
                                </form>
                                <p class="text-info mt-2 subscriber" style="display: none">Your email has been submitted.</p>
                            </div>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Single -->
@endsection
