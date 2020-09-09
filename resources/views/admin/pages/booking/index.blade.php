<?php
 $sidenav['request'] = 'active';
 $title = "Bookings";

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
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Customer</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allbookings as $booking)
                                    <tr>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->phone }}</td>
                                        <td>{{ $booking->seen?'Seen':'Unseen' }}</td>
                                        <td>{{ $booking->cartItems->count() }} items</td>
                                        <td title="{{ date('F d, Y', strtotime($booking->created_at)) }}">{{ $booking->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">No Booking found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{ $allbookings->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

