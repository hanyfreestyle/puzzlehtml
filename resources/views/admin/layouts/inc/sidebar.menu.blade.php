<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column {{sideBarNavUlStyle()}}" data-widget="treeview" role="menu" data-accordion="false">
        @foreach( config('adminMenu.menu') as $MenuList )
            @if($MenuList['type'] == 'one')
                <li class="nav-item">
                    <a href="{{ route($MenuList['url']) }}" class="nav-link  @if(Route::currentRouteName() == $MenuList['url']) active @endif ">
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
                        <p>{{$MenuList['text']}}<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($MenuList['submenu'] as $SubMenu)
                            <li class="nav-item">
                                <a href="{{ route($SubMenu['url']) }}" class="nav-link @if(Route::currentRouteName() == $SubMenu['url']) active @endif ">
                                    @if(isset($SubMenu['icon']))<i class="nav-icon {{$SubMenu['icon']}}"></i>@endif
                                    <p>{{$SubMenu['text']}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

        @endforeach
    </ul>
</nav>
