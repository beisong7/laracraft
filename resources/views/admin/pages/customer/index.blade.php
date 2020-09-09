<?php
 $sidenav['customers'] = 'active';
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
                        <a href="{{ route('customer.list') }}" class="btn btn-sm btn-dark mb-3">Customers</a>
                        <a href="{{ route('customer.list', ['type'=>'disabled']) }}" class="btn btn-sm btn-dark mb-3">Disabled Customers</a>
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Names</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->created_at->diffForHumans() }}</td>
                                        <td>
{{--                                            <a href="{{ route('user.show', $user->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>--}}
                                            <a href="{{ route('customer.toggle_active', $customer->uuid) }}" class="btn btn-sm btn-outline-danger">{{ $customer->active?'Remove':'Restore' }}</a>
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

