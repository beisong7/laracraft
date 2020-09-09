<?php
 $sidenav['content'] = 'active';
 $title = "Page";
 $newInstance = route('page.create');
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

                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($pages as $page)
                                    <tr>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->published?'Published':'Un Published' }}</td>
                                        <td>
                                            <a href="{{ route('page.edit', $page->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            @if($page->published)
                                                <a href="{{ route('page.unpublished', $page->uuid) }}" class="btn btn-sm btn-outline-danger" >Un publish</a>
                                            @else
                                                <a href="{{ route('page.publish', $page->uuid) }}" class="btn btn-sm btn-outline-danger" >Publish</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No page Items Found</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

