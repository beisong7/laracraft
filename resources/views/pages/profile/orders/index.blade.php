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
                            <li class="active"><a href="#">My Orders</a></li>
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
                                <h4>My Order List</h4>
                                <hr>
                            </div>

                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Items</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($bookings as $book)
                                            <tr>
                                                <td>{{ $book->created_at->diffForHumans() }}</td>
                                                {{--<td>--}}
                                                    {{--<div class="" style="width: 70px">--}}
                                                        {{--<img src="{{ url($wish->product->OnePic) }}" alt="{{ $wish->product->name }}">--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}
                                                <td>{{ $book->cartItems()->count() }}</td>
                                                <td>
                                                    @if($book->cancled)
                                                        You canceled this order
                                                    @else
                                                        {{ $book->handled?'Delivered':'Pending' }}
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($book->cancled)

                                                    @else
                                                        <a href="#" onclick="event.preventDefault(); deleteThis('{{ route('customer.drop_order', $book->uuid) }}')" class="baby-btn baby-btn-bg">
                                                            <i class="fa fa-trash"></i> Cancel
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('customer.view_order', $book->uuid) }}" class="baby-btn baby-btn-bg">
                                                        <i class="fa fa-eye"></i> View Items
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
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    {{--@include('layouts.news_letter_sub')--}}

@endsection
