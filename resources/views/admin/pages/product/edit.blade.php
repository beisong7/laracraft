<?php
$sidenav['content'] = 'active';
$title = "Product / Edit";
?>

@section('other_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/basic.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
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
                        <h5>Edit product</h5>
                        <hr>
                        <form method="POST" action="{{ route('product.update', $product->uuid) }}" aria-label="{{ __('new-mfr') }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('put') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus placeholder="prodct name" autocomplete="off">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Select Partner.</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="maker_id" id="" >
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
                                    <select class="form-control" name="category_id" id="">
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
                                    <input id="name" type="text" class="form-control" name="price" value="{{ $product->price }}" required placeholder="Current Price" autocomplete="off">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Old Price</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="old_price" value="{{ $product->old_price }}" placeholder="Previous Price" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">New Product? </label>

                                <div class="col-md-6">
                                    <input type="checkbox" class="" name="isnew" {{ $product->is_new?'checked':'' }}>

                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="name" class="col-md-2 col-form-label text-md-right">Images * (4 allowed)</label>

                                <div class="col-md-6">
                                    <div id="dropzone" class="dropzone" ></div>
                                    <p class="dz_respo text-danger mt-2 mb-0"></p>
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="name" class="col-md-2 col-form-label text-md-right">Images</label>


                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach($product->uploads as $image)
                                            <div class="col-sm-6 col-md-3">
                                                <img src="{{ $image->photo() }}" alt="" style="width: 100%">
                                                <a href="{{ route("upload-delete", $image->uuid) }}" class=" btn btn-block btn-outline-danger ">Remove <i class="fa fa-trash"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Detail </label>

                                <div class="col-md-6">
                                    <textarea id="" type="text" class="form-control" name="detail" required placeholder="product detail">{{ $product->details }}</textarea>
                                </div>
                            </div>


                            <hr>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-outline-dark btn-block">
                                        Update {{ $product->name }}
                                    </button>
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
    <script src="{{ asset('admin/plugins/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript">

        let minImageWidth = 100;
        let minImageHeight = 100;

        let md = new Dropzone("#dropzone", {
            url: '{{ route('uploadStore', $product->uuid) }}',
            maxFilesize: 4,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFiles: 4,
            renameFile: function(file) {
                let dt = new Date();
                let time = dt.getTime();
                return time+file.name;
            },
            removedfile: function(file) {
                let name = file.upload.filename;
                console.log(file);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route("uploadDelete", $product->uuid) }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                let fileRef;
                return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            addRemoveLinks: true,
            init: function () {
                this.on("thumbnail", function (file) {
                    if (file.width < minImageWidth || file.height < minImageHeight) {
                        file.rejectDimensions()
                    }
                    else {
                        file.acceptDimensions();
                    }
                });
            },
            accept: function (file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() {
                    done("Image width or height too small... min = 500 x 200.");
                    toastr(`The file '${file.name}' either has width or height too small. minimum 500 x 200 required.`);
                    setTimeout(() => {
                        file.previewElement.remove();
                    }, 5500);

                };

            },
            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                console.log(response);
                return false;
            }


        });

        function toastr(msg) {
            let dzr = $('.dz_respo');
            dzr.show();
            dzr.text(msg);
            setTimeout(() => {
                dzr.text("")
                dzr.hide()
            }, 5500);

        }

        function keeper() {
            Dropzone.options.dropzone =
                {
                    maxFilesize: 10,
                    renameFile: function(file) {
                        let dt = new Date();
                        let time = dt.getTime();
                        return time+file.name;
                    },
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 50000,
                    maxFiles: 4,
                    removedfile: function(file) {
                        let name = file.upload.uuid;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ route("uploadDelete", $product->uuid) }}',
                            data: {filename: name},
                            success: function (data){
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        let fileRef;
                        return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    }
                };
        }

    </script>
@endsection