<?php
 $sidenav['products'] = 'active';
 $title = "product";
 $newInstance = route('product.create');
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

                                    <th scope="col">Name</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Hits</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->details }}</td>
                                        <td>{{ $product->hits() }}</td>
                                        <td>

                                            <a href="{{ route('product.show', $product->uuid) }}" class="btn btn-sm btn-outline-dark">Show</a>
                                            <a href="{{ route('product.edit', $product->uuid) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteThis('{{ route('product.pop', $product->uuid) }}')">Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">No product Items Found</p>
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

