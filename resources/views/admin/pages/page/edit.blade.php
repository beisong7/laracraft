<?php
$sidenav['page'] = 'active';
$title = "Page / Edit";
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
                        <h5>Edit Page</h5>
                        <hr>
                        <form action="{{ route('page.update', $page->uuid) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Page Title </label>
                                    <input type="text" class="form-control" placeholder="Page Name" name="title" required autocomplete="off" value="{{ $page->title }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Page Group</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Details</label>
                                    <textarea rows="10" name="info" class="myfield form-control">{!! $page->info !!}</textarea>
                                </div> <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Update Page  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @include('admin.pages.blog.tinymyce')
@endsection

