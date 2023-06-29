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

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{sideBarNavUlStyle()}}" data-widget="treeview" role="menu" data-accordion="false">
                @foreach( config('adminMenu.menu') as $MenuList )
                    @if(isset($MenuList['view']) and $MenuList['view'] == true)
                        @if($MenuList['type'] == 'one')
                            <li class="nav-item">
                                <a href="{{ route($MenuList['url']) }}" class="nav-link  @if(Route::is($MenuList['sel_routs'].'.*')) active @endif ">
                                    @if(isset($MenuList['icon']))<i class="nav-icon {{$MenuList['icon']}}"></i>@endif
                                    <p>{{$MenuList['text']}}</p>
                                </a>
                            </li>
                        @elseif($MenuList['type'] == 'many')
                            <li class="nav-item
                        @foreach($MenuList['submenu'] as $SubMenu)
                            @if( Route::currentRouteName() == $SubMenu['url'] ) menu-open @endif
                            @endforeach">

                                <a href="#" class="nav-link
                            @foreach($MenuList['submenu'] as $SubMenu)
                                @if( Route::currentRouteName() == $SubMenu['url'] ) active @endif
                                @endforeach">

                                    @if(isset($MenuList['icon']))<i class="nav-icon {{$MenuList['icon']}}"></i>@endif
                                    <p>
                                        {{__($MenuList['text'])}}
                                        @if( thisCurrentLocale() == 'ar')
                                            <i class="right fas fa-angle-left"></i>
                                        @else
                                            <i class="right fas fa-angle-right"></i>
                                        @endif
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach($MenuList['submenu'] as $SubMenu)
                                        <li class="nav-item">
                                            <a href="{{ route($SubMenu['url']) }}" class="nav-link @if(Route::currentRouteName() == $SubMenu['url']) active @endif ">
                                                @if(isset($SubMenu['icon']))<i class="nav-icon {{$SubMenu['icon']}}"></i>@endif
                                                <p>
                                                    {{__($SubMenu['text'])}}
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
