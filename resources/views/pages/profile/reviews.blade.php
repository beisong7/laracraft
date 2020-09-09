<?php
$navlink['contact_us'] = 'active';
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
                            <li class="active"><a href="#">My Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                @include('layouts.notice')
                <div class="row">
                    @include('pages.profile.template.sidebar')
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>My Wish List</h4>
                                <hr>
                            </div>

                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($reviews as $review)
                                            <tr>
                                                <td>{{ $review->productName }}</td>
                                                <td>
                                                    <div class="" style="width: 70px">
                                                        <img src="{{ url($review->productPic) }}" alt="{{ $review->productName }}">
                                                    </div>
                                                </td>
                                                <td>{{ $review->created_at->diffForHumans() }}</td>
                                                <td>
                                                   {{ $review->info }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Item</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <hr>
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    {{--@include('layouts.news_letter_sub')--}}

@endsection
