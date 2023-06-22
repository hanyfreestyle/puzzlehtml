<!DOCTYPE html>
<html lang="en" {!!htmlArDir()!!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('adminConfig.title')}}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">
    @yield('StyleFile')
    @if(config('adminConfig.pace_progress') == true and config('adminConfig.preloader') == false)
        <link rel="stylesheet" href="{{ defAdminAssets('plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    @endif
    <link rel="stylesheet" href="{{defAdminAssets('css/adminlte.css')}}">

    @if( thisCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ defAdminAssets('rtl/css/adminlte-rtl.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('rtl/css/custom.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('rtl/css/custom_ar.css') }}">
    @endif
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

<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@yield('JsFileBeforeAdminlte')

@if(config('adminConfig.pace_progress') == '1' and config('adminConfig.preloader') == false)
<script src="{{ defAdminAssets('plugins/pace-progress/pace.min.js') }}"></script>
@endif

<script src="{{ defAdminAssets('js/adminlte.min.js')}}"></script>
<script src="{{ defAdminAssets('js/custom_file.js') }}"></script>
@yield('JsCode')
<script>
    @if( thisCurrentLocale() == 'ar')
    async function loadarfont(){
        const font_ar = new FontFace('Tajawal','url({{ defAdminAssets('fonts/Ar/TajawalRegular.woff2') }}');
        await font_ar.load();
        document.fonts.add(font_ar);
        document.body.classList.add('Tajawal');
    };
    loadarfont();
    @endif
    display_c7();
</script>
</body>
</html>
