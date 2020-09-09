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
        <div class="row">
            @include('admin.pages.dashboard.top_cards')
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

