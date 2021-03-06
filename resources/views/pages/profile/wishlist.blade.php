<?php
$navlink['contact_us'] = 'active';
$title = "My Wish list";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')


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
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($wishes as $wish)
                                            <tr>
                                                <td>{{ $wish->product->name }}</td>
                                                <td>
                                                    <div class="" style="width: 70px">
                                                        <img src="{{ url($wish->product->OnePic) }}" alt="{{ $wish->product->name }}" style="width: 100%">
                                                    </div>
                                                </td>
                                                <td>{{ $wish->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('customer.pop_wish', $wish->uuid) }}" class="baby-btn baby-btn-bg">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('preview.product', $wish->product->uuid) }}" class="baby-btn baby-btn-bg">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
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
                            {{ $wishes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    {{--@include('layouts.news_letter_sub')--}}

@endsection
