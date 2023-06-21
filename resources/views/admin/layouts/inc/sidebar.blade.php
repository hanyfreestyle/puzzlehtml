<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.Dashboard')}}" class="brand-link">
        <img src="{{defAdminAssets('img/LogoIcon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{defAdminAssets('img/user_avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.Dashboard')}}" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        @if(config('adminConfig.sidebar_navbar_search') == true)
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
        @endif
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{sideBarNavUlStyle()}}" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item {{openMenu(['admin.Dashboard','admin.page1','admin.page2'])}}">
                    <a href="#" class="nav-link {{ areActiveRoutes(['admin.Dashboard','admin.page1','admin.page2'])}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Menu 1<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.page1') }}" class="nav-link {{ areActiveRoutes(['admin.page1'])}}"><i class="far fa-circle nav-icon"></i>
                                <p>Page1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.page2') }}" class="nav-link {{ areActiveRoutes(['admin.page2'])}}"><i class="far fa-circle nav-icon"></i>
                                <p>Page2</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{openMenu(['admin.Dashboard2','admin.page3','admin.page4'])}}">
                    <a href="#" class="nav-link {{ areActiveRoutes(['admin.Dashboard2','admin.page3','admin.page4'])}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Menu 2<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.page3') }}" class="nav-link {{ areActiveRoutes(['admin.page3'])}}"><i class="far fa-circle nav-icon"></i>
                                <p>Page3</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.page4') }}" class="nav-link {{ areActiveRoutes(['admin.page4'])}}"><i class="far fa-circle nav-icon"></i>
                                <p>Page4</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
