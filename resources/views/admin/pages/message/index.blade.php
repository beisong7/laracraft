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
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Sender</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allmessages as $message)
                                    <tr>
                                        <td>{{ $message->names }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->seen?'Seen':'Unread' }}</td>
                                        <td title="{{ date('F d, Y', strtotime($message->created_at)) }}">{{ $message->created_at->diffForHumans() }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>
                                            <a href="{{ route('message.show', $message->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <p class="text-center">No Message found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{ $allmessages->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

