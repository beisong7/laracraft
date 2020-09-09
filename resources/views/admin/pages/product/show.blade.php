<?php
$sidenav['content'] = 'active';
$title = "Product / Edit";
?>

@section('other_css')

@endsection

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
                        <h5>Showing {{ $product->name }} <a href="{{ route('product.edit', $product->uuid) }}" class="btn btn-sm btn-outline-primary float-right">Edit Product</a></h5>
                        <hr>
                        <form method="POST" action="#" aria-label="{{ __('new-mfr') }}" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" disabled autofocus placeholder="prodct name" autocomplete="off" disabled="disabled">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Select Partner.</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="maker_id" id="" disabled>
                                        <option value=""></option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ $product->maker_id === $maker->uuid?'selected':'' }}>{{ $maker->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Select Category</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="category_id" id="" disabled disabled>
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->uuid }}" {{ $product->category_id===$category->uuid?'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Current Price</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="price" value="{{ $product->price }}" disabled placeholder="Current Price" autocomplete="off">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Old Price</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="old_price" value="{{ $product->old_price }}" placeholder="Previous Price" autocomplete="off" disabled="disabled">
                                </div>
                            </div>


                            <div class="form-group row">

                                <label for="name" class="col-md-2 col-form-label text-md-right">Images</label>


                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach($product->uploads as $image)
                                            <div class="col-sm-6 col-md-3">
                                                <img src="{{ $image->photo() }}" alt="" style="width: 100%">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Detail </label>

                                <div class="col-md-6">
                                    <textarea id="" type="text" class="form-control" name="detail" disabled placeholder="product detail">{{ $product->details }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection


@section('other_js')

@endsection