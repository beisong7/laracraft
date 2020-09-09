<?php
 $sidenav['content'] = 'active';
 $title = "Categories / New";
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
                        <h5>Create New Category</h5>
                        <hr>
                        <form action="{{ route('category.update',  $category->uuid) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Category Name</label>
                                    <input type="text" class="form-control" placeholder="Category Name" name="name" required autocomplete="off" value="{{ $category->name }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Category Group</label>
                                    <select name="group_id" id="" class="form-control">
                                        <option value=""></option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->uuid }}" {{ $category->group_id===$group->uuid?'selected':'' }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Details</label>
                                    <textarea type="text" class="form-control" placeholder="Details abount the category" name="details">{{ $category->details }}</textarea>
                                </div> <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Update Category  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

