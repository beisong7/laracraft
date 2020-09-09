<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3"> Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ @$sidenav['dashboard'] }}">
        <a class="nav-link" href="{{ route('cms.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administration
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ @$sidenav['users'] }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Admins</h6>
                <a class="collapse-item" href="{{ route('user.index') }}">All Admin</a>
                <a class="collapse-item" href="#">Inactive Admin</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ @$sidenav['customers'] }}">
        <a class="nav-link" href="{{ route('customer.list') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Customers</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Operations
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ @$sidenav['content'] }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Contents</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Actions</h6>
                <a class="collapse-item" href="{{ route('product.index') }}"> Products</a>
                <a class="collapse-item" href="{{ route('category.index') }}">Categories</a>
                <a class="collapse-item" href="{{ route('category_group.index') }}">Category Groups</a>
                <a class="collapse-item" href="{{ route('maker.index') }}">Manufacturer</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Publications:</h6>
                <a class="collapse-item" href="{{ route('blog.index') }}">Blogs</a>
                <a class="collapse-item" href="{{ route('content.index') }}">Blog Category</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ @$sidenav['request'] }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-parachute-box"></i>
            <span>Requests</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Orders</h6>
                <a class="collapse-item" href="{{ route('booking.index', ['status'=>'unread']) }}">Unseen</a>
                <a class="collapse-item" href="{{ route('booking.index') }}">All</a>
                <h6 class="collapse-header">Messages</h6>
                <a class="collapse-item" href="{{ route('message.index', ['status'=>'unread']) }}">Unread</a>
                <a class="collapse-item" href="{{ route('message.index') }}">All</a>
                <h6 class="collapse-header">Reviews</h6>
                <a class="collapse-item" href="{{ route('reviews.made', 'submitted') }}">Submitted</a>
                <a class="collapse-item" href="{{ route('reviews.made', 'active') }}">Active</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ @$sidenav['slider'] }}">
        <a class="nav-link" href="{{ route('slider.index') }}">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>Home Sliders</span></a>
    </li>

    <li class="nav-item {{ @$sidenav['page'] }}">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Pages</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->