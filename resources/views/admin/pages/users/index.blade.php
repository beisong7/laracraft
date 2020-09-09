<?php
 $sidenav['users'] = 'active';
 $title = "Admin";
 $newInstance = route('user.create');
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

                                    <th scope="col">Names</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role() }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>

                                            <a href="{{ route('user.show', $user->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

