<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-lg-3">
                    <div class="all-category">
                        <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                        <ul class="main-category">
                            @foreach($categories as $category)
                                <li><a href="{{ route('view.products', ['category'=>$category->name]) }}">{{ $category->name }}</a></li>
                            @endforeach

                            @if($length > 5)
                                <li><a href="#">More</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">
                                <div class="nav-inner">
                                    @include('layouts.header.navlinks')
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>