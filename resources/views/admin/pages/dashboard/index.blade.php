<?php
 $sidenav['dashboard'] = 'active';
 $title = "Dashboard";
?>
@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        @include('admin.layouts.breadcrumb')
        @include('layouts.notice')

        <!-- Content Row -->
        <h5>Overview</h5>
        <div class="row">
            @include('admin.pages.dashboard.top_cards')
        </div>
        <br>
        <h5>Quick Links</h5>
        <div class="row">
            @include('admin.pages.dashboard.quick_link')
        </div>

        <br>
        <h5>Transactions</h5>
        <div class="row">
            @include('admin.pages.dashboard.transactions')
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

