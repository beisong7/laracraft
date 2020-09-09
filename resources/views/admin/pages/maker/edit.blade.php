<?php
 $sidenav['content'] = 'active';
 $title = "Manufacturer / Edit";
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
                        <h5>Create New Category</h5>
                        <hr>
                        <form action="{{ route('maker.update', $maker->uuid) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Corporate Name</label>
                                    <input type="text" class="form-control" placeholder="Corporate Name" name="name" required autocomplete="off" value="{{ $maker->name }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" required autocomplete="off" value="{{ $maker->phone }}">
                                </div> <!-- form-group end.// -->

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Update Manufacturer  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

