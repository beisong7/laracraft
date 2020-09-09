<?php
 $sidenav['content'] = 'active';
 $title = "Category";
 $newInstance = route('category.create');
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
                                    <th scope="col">Group</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ !empty($category->group)?$category->group->name:'No Group Yet' }}</td>
                                        <td>{{ $category->products()->count() }}</td>
                                        <td>{{ $category->status() }}</td>
                                        <td>

                                            <a href="{{ route('category.edit', $category->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteThis('{{ route('category.pop', $category->uuid) }}')">Remove</a>
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

