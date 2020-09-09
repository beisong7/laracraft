<?php
 $sidenav['content'] = 'active';
 $title = "Category Group / New";
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
                        <form action="{{ route('category_group.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>* Group Name</label>
                                    <input type="text" class="form-control" placeholder="Category Group Name" name="name" required autocomplete="off" value="{{ old('name') }}">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Category Group Type</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="multiple">Multiple Child</option>
                                        <option value="single">Only One Child</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label>Use as Manufacturer Link?</label>
                                    <select name="maker_id" id="" class="form-control">
                                        <option value="">None</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->uuid }}">{{ $maker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Details</label>
                                    <textarea type="text" class="form-control" placeholder="Details abount the category group" name="details">{{ old('details') }}</textarea>
                                </div> <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Create Category  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

