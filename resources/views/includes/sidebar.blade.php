<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
    <img src="images/Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light"> RHU V.I.M.S.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="/storage/images/{{ Session::get('image') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{route('edit.profile', auth()->user()->id)}}"class="d-block">{{ Session::get('user') }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-list"></i>
                    <p>Categories</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('stocks.index')}}" class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-list-alt"></i>
                    <p>Stocks</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('patients.index')}}" class="nav-link {{ Request::is('patients*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                    <p>Patients</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('transactions.index')}}" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">
                <i class="nav-icon far fa-clipboard"></i>
                    <p>Transactions</p>
                </a>
            </li>
        
        </ul>
        
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>