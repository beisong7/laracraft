<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    @if(!empty($newInstance))
        <a href="{{ $newInstance }}" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New {{ $title }}</a>
    @endif
</div>