<?php
 $sidenav['products'] = 'active';
 $title = "Manufacturer";
 $newInstance = route('maker.create');
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
                                    <th scope="col">Phone</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($makers as $maker)
                                    <tr>
                                        <td>{{ $maker->name }}</td>
                                        <td>{{ $maker->phone }}</td>
                                        <td>{{ $maker->products()->count() }}</td>
                                        <td>{{ $maker->active?'Active':'Inactive' }}</td>
                                        <td>

                                            <a href="{{ route('maker.edit', $maker->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); deleteThis('{{ route('maker.pop', $maker->uuid) }}')">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No Manufacturer Found</p>
                                        </td>
                                    </tr>
                                @endforelse
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

