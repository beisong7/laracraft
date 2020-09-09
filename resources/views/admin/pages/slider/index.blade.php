<?php
 $sidenav['slider'] = 'active';
 $title = "Slider";
 $newInstance = route('slider.new');
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
                        <a href="{{ route('slider.index',['type'=>'active']) }}" class="btn btn-sm btn-outline-dark">Active</a>
                        <a href="{{ route('slider.index',['type'=>'inactive']) }}" class="btn btn-sm btn-outline-dark">Review</a>
                        <br>
                        <div class="table-responsive-sm mt-3">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            <div class="" style="max-width: 100px">
                                                <img src="{{ $slider->image }}" alt="slider-image" style="width: 100%">
                                            </div>
                                        </td>
                                        <td>{{ $slider->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('slider.show', $slider->uuid) }}" class="btn btn-dark btn-sm">Manage</a>
                                            <a href="{{ route('slider.toggle', $slider->uuid) }}" class="btn btn-outline-danger btn-sm">{{ $slider->active?'Remove':'Activate' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

