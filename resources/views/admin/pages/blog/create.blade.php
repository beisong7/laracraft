<?php
 $sidenav['users'] = 'active';
 $title = "Blog / New";
?>
@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.layouts.breadcrumb')
        @include('layouts.notice')

        <!-- Content Row -->
        <div class="row">
            <div class="col-10 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5>Create New Blog</h5>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('blog.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}

                                    <fieldset>

                                        <div class="row">

                                            <label class="col-sm-2 control-label" for="textinput">Slug</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="slug" placeholder="slug. e.g: how-to-make-money (no spaces)" class="form-control" required value="{{ old('slug') }}">
                                            </div>

                                            <label class="col-sm-2 control-label" for="textinput">Category</label>
                                            <div class="col-sm-4">
                                                <select name="category_id" class="form-control" id="" required>
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div >

                                        <br>

                                        <div class="row">
                                            <label class="col-sm-2 control-label" for="textinput">Banner</label>
                                            <div class="col-sm-4">
                                                <input class="" type="file" name="banner" accept="image/*" onchange="shwimg($(this))" id="imgInp" required >
                                            </div>
                                        </div >

                                        <br>
                                        <div class="form-group">

                                            <div class="col-sm-10">
                                                <p><small style="color: red">note: dimensions must be 950 x 400 pixels </small></p>
                                                <div class="text-center" style="max-height: 400px; padding: 0; border-radius: 5px; margin: 0 auto; background: #a7a7a7">
                                                    <img id="imgtoshow"  src="{{ url('images/default.png') }}" class="img-fit-h single_img" style="width: 100%; max-height: 100%;" alt="">
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label" for="textinput">Title</label>
                                            <textarea type="text" rows="2" name="title" placeholder="Blog Title" class="form-control" required>{{ old('title') }}</textarea>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="textinput">Description</label>
                                            <textarea type="text" rows="2" name="desc" placeholder="Blog Description" class="form-control" required>{{ old('desc') }}</textarea>
                                        </div>




                                        <div class="form-group">
                                            <label class=" control-label" for="textinput">Tags</label>
                                            <p><small>please separate each tag with a space and each tag must be one word</small></p>
                                            <textarea type="text" rows="2" name="tags" placeholder="Blog tags related. e.g: #Money #Training #Housing" class="form-control" required>{{ old('tags') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class=" control-label" for="textinput">Detail</label>
                                            <textarea rows="20" name="detail" class="myfield form-control">{!! old('detail') !!}</textarea>
                                        </div >

                                        <div class="form-group" style="margin-bottom: 50px">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-sm btn-outline-dark btn-block">Save</button>
                                            </div>

                                        </div>

                                    </fieldset>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @include('admin.pages.blog.tinymyce')
@endsection

