<?php
$navlink['product'] = 'active';
$title = "Shop Product";
?>
@extends('layouts.main')

@section('content')

    @include('layouts.header')


    <section>

        <div class="shop-page">
            <div class="container">
                <div class="row shop">
                    <div class="col-md-8 col-sm-6 col-xs-12 shoppage1">
                        <div class="we-found">
                            <p style="color: #a1a1a1">Showing <strong> {{ $shown }} </strong></p>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="{{ route('view.products') }}" class="category-item baby-btn baby-btn-bg">
                        <b>All Category</b>
                    </a>

                    <a href="{{ route('view.products',['latest'=>'y']) }}" class="category-item baby-btn baby-btn-bg">
                        <b>New Arrivals</b>
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('view.products', ['category'=>$category->name]) }}" class="category-item baby-btn baby-btn-bg">
                            <b>{{ $category->name }}</b>
                        </a>
                    @endforeach
                </div>

                <div class="border shopv1"></div>
            </div>
        </div>
        <!-- Products -->
        <div class="list shop6">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    @include('pages.product.single_product2')
                                </div>
                            @empty
                                <div class="col p-5" style="padding: 100px">
                                    <h5 class="text-muted text-center">No Product Available.</h5>
                                </div>
                            @endforelse
                        </div>



                        <div class="loadmore">
                            <?php try{ ?>
                            {{ $products->links() }}
                            <?php }catch(\Exception $e){} ?>
                        </div>
                    </div>
                </div>
                <div class="border"></div>
            </div>
        </div>
    </section>

    <!--/ End Product Style 1  -->
@endsection
