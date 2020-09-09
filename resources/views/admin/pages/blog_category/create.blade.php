<?php
 $sidenav['users'] = 'active';
 $title = "Blog Category / New";
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
                        <h5>Create New Blog Category</h5>
                        <hr>
                        <form action="{{ route('content.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Category Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" required autocomplete="off" value="{{ old('name') }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Info</label>
                                    <textarea type="text" class="form-control" placeholder="Information of Category" name="info" autocomplete="off">{{ old('info') }}</textarea>
                                </div> <!-- form-group end.// -->

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Create Blog Category</button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

