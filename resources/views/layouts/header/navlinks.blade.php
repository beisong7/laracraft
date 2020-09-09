<ul class="nav main-menu menu navbar-nav">
    <li class="{{ @$navlink['home'] }}"><a href="{{ route('home') }}">Home</a></li>
    {{--<li class="{{ @$navlink['product'] }}"><a href="{{ route('view.products') }}">Products</a></li>--}}

    @foreach($groups as $group)
        @if($group->type==='single')
            @if(!empty($group->singleChild))
                <li><a href="{{ route('view.products', ['category'=>$group->singleChild->name]) }}">{{ $group->singleChild->name }}</a></li>
            @endif
        @else
            <li><a href="#">{{ $group->name }}<i class="ti-angle-down"></i></a>
                @if($group->categories->count() > 0)
                    <ul class="dropdown">
                        @foreach($group->categories as $category)
                            <li><a href="{{ route('view.products', ['category'=>$category->name]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif

    @endforeach

    <li class="{{ @$navlink['product'] }}"><a href="{{ route('view.products',['latest'=>'y']) }}">New Arrivals</a></li>

</ul>
