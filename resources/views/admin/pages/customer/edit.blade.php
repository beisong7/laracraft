<?php
 $sidenav['users'] = 'active';
 $title = "Admin / Edit";
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
                        <h5>Manage existing Account</h5>
                        <hr>
                        <form action="{{ route('user.update', $user->uuid) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Full Name</label>
                                    <input type="text" class="form-control" placeholder="" name="name" required autocomplete="off" value="{{ $user->name }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>* Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="" autocomplete="off" required value="{{ $user->email }}">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone" name="phone" required autocomplete="off" value="{{ $user->phone }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="dob" placeholder="" value="{{ $user->dob }}">
                                </div>
                            </div> <!-- form-row end.// -->

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>* Address</label>
                                    <input type="text" name="address" class="form-control" autocomplete="off" value="{{ $user->address }}">
                                </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <label>Role</label>
                                    <select id="" class="form-control" name="who">
                                        <option disabled selected> Choose...</option>
                                        <option value="4" {{ $user->who === 4?'selected':'' }}>Super Admin</option>
                                        <option value="3" {{ $user->who === 3?'selected':'' }}>Admin</option>
                                        <option value="2" {{ $user->who === 2?'selected':'' }}>Staff</option>
                                        <option value="1" {{ $user->who === 1?'selected':'' }}>Guest</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row.// -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Update Account  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

