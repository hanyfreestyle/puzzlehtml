@extends('admin.layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>

                            <p class="card-text">
                     {{Route::currentRouteName()}}
                                <br>
                                {{ intval(request()->is('admin/Config/*') )}}
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('content')

    @foreach( config('adminMenu.menu') as $MenuList )
        {{print_r($MenuList)}}
        {{($MenuList['type'])}}

        @if($MenuList['type'] == 'one')
            <li class="nav-item">
                <a href="#" class="nav-link {{ areActiveRoutes(['admin.Dashboard','admin.page1','admin.page2'])}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Menu 1<i class="right fas fa-angle-left"></i></p>
                </a>
            </li>
        @endif
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
    @endforeach
@endsection



