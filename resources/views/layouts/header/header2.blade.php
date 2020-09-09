<div class="header-center pro-v1 hp1" style="background-color: #2BB24C; {{ empty($isHome)?'margin-bottom: 0px;':'' }}" >
    <div class="container">
        <!-- push-menu -->
        <a href="#" class="icon-pushmenu js-push-menu">
            <i class="fa fa-bars" aria-hidden="true"></i></a>
        <div class="row flex align-items-center justify-content-between">
            <div class="col-md-6 col-xs-12 col-sm-6 col2 flex justify-content-end">
                <ul class="nav navbar-nav js-menubar hidden-xs hidden-sm">

                    <li class="level1 active dropdown home-page-v1-st style-menu-home-1 nav-a">
                        <a class="menu-home-3 home-1-font" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="level1 active dropdown home-page-v1-st style-menu-home-1 nav-a" > <!-- style="margin-left: 50px" -->
                        <a class="menu-home-3 home-1-font" href="{{ route('view.products') }}">Shop Now</a>
                    </li>

                    <li class="level1 active dropdown home-page-v1-st style-menu-home-1 nav-a" > <!-- style="margin-left: 50px" -->
                        <a class="menu-home-3 home-1-font" href="{{ route('contact-us') }}">Contact Us</a>
                    </li>
                    @foreach($groups as $group)
                        @if($group->type==='single')
                            @if(!empty($group->singleChild))
                                <li class="level1 active dropdown home-page-v1-st style-menu-home-1">
                                    <a class="menu-home-3 home-1-font" href="{{ route('view.products', ['category'=>$group->singleChild->name]) }}">{{ $group->singleChild->name }}</a>
                                </li>
                            @endif
                        @else
                            <li class="level1 dropdown hassub style-menu-home-1">
                                <a class="menu-home-3 home-1-font" href="#">{{ $group->name }}</a>
                                <span class="plus js-plus-icon"></span>
                                <div class="menu-level-1 dropdown-menu style2 dropdown-hp1 about-megamenu">
                                    @if($group->categories->count() > 0)
                                        <ul class="level1">
                                            <li class="level2 col-4">
                                                <a href="">{{ $group->name }}</a>
                                                <ul class="menu-level-2">
                                                    @foreach($group->categories as $category)
                                                        <li class="level3"><a href="{{ route('view.products', ['category'=>$category->name]) }}">{{ $category->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif

                                    <div class="clearfix"></div>
                                </div>
                            </li>

                        @endif

                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6 carts">
                <div class="search3 search-home-1">
                    <form method="post" action="{{ route('find.item') }}" role="search" class="search-form  has-categories-select">
                        {{ csrf_field() }}
                        <input name="keyword" class="search-input" type="text" value="{{ @$keyword }}" placeholder="Search..." autocomplete="off">
                        <button type="submit" id="search-btn"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                @if(empty($hide_mini_cart))

                    <div class="date3 dropdown">
                        @include('layouts.cart')

                        <div class="para-a a4">
                            <h4><a href="{{ route('cart') }}">My Cart</a></h4>
                            <p><span class="total-count">{{ !empty($cartItems)?count($cartItems):0 }} </span></p>
                            <span class="total-price"> Items</span>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>