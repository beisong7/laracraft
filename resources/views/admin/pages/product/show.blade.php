<?php
$sidenav['content'] = 'active';
$title = "Product / Details";
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
                        <h5>
                            Showing {{ $product->name }}
                            <a href="{{ route('product.edit', $product->uuid) }}" class="btn btn-sm btn-outline-primary ml-2 float-right">Edit Product</a>
                            <button type="button" class="btn btn-sm btn-outline-primary float-right mr-2" data-toggle="modal" data-target="#attributeBox">Add Attributes</button>
                        </h5>
                        <hr>
                        <div class="">
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

                            @if($product->sizes->count() > 0)
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">Sizes</label>

                                    @foreach($product->sizes as $size)
                                        <div class="col-md-1 text-center m-1 shadow-sm">
                                            <span style="font-size: 12px">{{ $size->info->measure }}</span>
                                            <br>
                                            <span style="font-size: 12px; font-weight: 800">{{ $size->info->name }}</span>

                                        </div>
                                    @endforeach

                                </div>
                            @endif

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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection


@section('other_js')
    <div class="modal fade" id="attributeBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Attributes to {{ $product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product.add.attribute', $product->uuid) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <p class="mb-0">Attribute Type</p>
                                <select name="type" class="form-control" id="type-switch">
                                    <option value="size">Size</option>
                                    <option value="color">Color</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <p class="mb-0">Attribute Title</p>
                                <input type="text" class="form-control" name="a_title" placeholder="Attribute Title" required autocomplete="off">
                            </div>
                            <div class="col-6 mb-3 for_size">
                                <p class="mb-0">Attribute Value</p>
                                <input type="text" class="form-control" placeholder="Size" name="a_value" autocomplete="off">
                            </div>
                            <div class="col-6 mb-3 for_color" style="display: none">
                                <input type="color" class="form-control" placeholder="Attribute Color" autocomplete="off" name="a_color">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Add Attribute</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        let attributeType = $('#type-switch');
        attributeType.on('change', function (e) {
            if($(this).val()==='color'){
                $('.for_color').show();
                $('.for_size').hide();
            }
            if($(this).val()==='size'){
                $('.for_size').show();
                $('.for_color').hide();
            }
        })
    </script>

@endsection