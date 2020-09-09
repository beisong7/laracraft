<?php
 $sidenav['request'] = 'active';
 $title = "Messages";

?>
@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.layouts.breadcrumb')
        @include('layouts.notice')

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <a class="btn btn-dark btn-sm mb-3" href="{{ route('reviews.made', 'submitted') }}">Submitted</a>
                        <a class="btn btn-dark btn-sm mb-3" href="{{ route('reviews.made', 'active') }}">Active</a>

                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Sender</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Remark / Review</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reviews as $review)
                                    <tr>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->info }}</td>
                                        <td>{{ $review->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('product.show', $review->product_key) }}" class="btn btn-sm btn-outline-primary">Show Product</a>
                                            <a href="{{ route('review.toggle', $review->uuid) }}" class="btn btn-sm btn-outline-dark">{{ $review->active?'Drop':'Approve' }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">No Review found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{ $reviews->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

