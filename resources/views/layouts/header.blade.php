@include('layouts.pushmenu')

<!-- Header -->
<header id="header" class="header-v2">
    <!-- Topbar -->
{{--    @include('layouts.header.topbar')--}}

    <!-- End Topbar -->
    @include('layouts.header.middle')

<!-- Header Inner -->
    @if(!empty($mainHeader))
        @include('layouts.header.header')
    @else
        @include('layouts.header.header2')
    @endif
    <!--/ End Header Inner -->
    @if(empty($isHome))
        <!-- Breadcrumbs -->
            <div class="luc2 v4">
                <h2>{{ !empty($title)?$title:env('APP_NAME', '') }}</h2>
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">/</a></li>
                    <li><a href="#">{{ !empty($title)?$title:'' }}</a></li>
                </ul>
            </div>
            <!-- End Breadcrumbs -->
    @endif
</header>
<!--/ End Header -->