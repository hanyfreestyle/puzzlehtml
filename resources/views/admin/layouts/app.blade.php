<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{defAdminAssets('css/adminlte.min.css')}}">
</head>
<body class="hold-transition {{ mainBodyStyle() }}">
<div class="wrapper">

    <!-- Navbar -->
@include('admin.layouts.inc.top_navbar')
<!-- Main Sidebar Container -->
@include('admin.layouts.inc.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>


    <!-- Control Sidebar -->
    @if(config('adminConfig.top_navbar_control') == true)
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    @endif


    @include('admin.layouts.inc.footer')
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{defAdminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{defAdminAssets('js/adminlte.min.js')}}"></script>
</body>
</html>
