<?php
 $sidenav['content'] = 'active';
 $title = "Category Group";
 $newInstance = route('category_group.create');
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
                                    <th scope="col">Categories</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->categories->count() }}</td>
                                        <td>{{ $group->type }}</td>
                                        <td>{{ $group->active?'Active':'Inactive' }}</td>
                                        <td>

                                            <a href="{{ route('category_group.edit', $group->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteThis('{{ route('category_group.pop', $group->uuid) }}')">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No Category Items Found</p>
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

