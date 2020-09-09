<?php
 $sidenav['products'] = 'active';
 $title = "Blogs";
 $newInstance = route('blog.create');
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
                    <div class="card-body mb-4">
                        <a href="{{ route('blog.index', ['status'=>'published']) }}" class="btn btn-outline-dark btn-sm">Published</a>
                        <a href="{{ route('blog.index', ['status'=>'unpublished']) }}" class="btn btn-outline-dark btn-sm">UnPublished</a>
                        <br>
                        <div class="table-responsive-sm mt-3">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Title</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Hits</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->slug }}</td>
                                        <td>{{ $blog->status() }}</td>
                                        <td>{{ $blog->hits }}</td>
                                        <td>

                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-dark">Manage</a>
                                            <a href="{{ route('blog.toggle', $blog->id) }}" class="btn btn-sm btn-outline-primary">{{ $blog->status?'Unpublish':'Publish' }}</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); deleteThis('{{ route('blog.pop', $blog->id) }}')">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No Blogs Found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <br>

                    </div>

                    {{ $blogs->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

