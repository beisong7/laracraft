<?php
 $sidenav['content'] = 'active';
 $title = "Blog Categories";
 $newInstance = route('content.create');
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
                                    <th scope="col">Info</th>
                                    <th scope="col">Blogs</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($contents as $content)
                                    <tr>
                                        <td>{{ $content->name }}</td>
                                        <td>{{ $content->info }}</td>
                                        <td>{{ $content->blogs()->count() }}</td>
                                        <td>

                                            <a href="{{ route('content.edit', $content->id) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); deleteThis('{{ route('content.pop', $content->id) }}')">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center">No Category Found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{ $contents->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

