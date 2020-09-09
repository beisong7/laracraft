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
                        <p>Message from {{ $message->names }}</p>
                        <h5>Subject: <b>{{ $message->subject }}</b></h5>
                        <hr>
                        <div class="">
                            {{ $message->info }}
                        </div>
                        <hr>
                        <div class="text-muted">
                            <p><i><small>Sent: {{ $message->created_at->diffForHumans() }}</small></i></p>
                            <p><i><small>Email: {{ $message->email }}</small></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

