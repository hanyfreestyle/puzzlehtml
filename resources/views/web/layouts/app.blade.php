<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  {!!htmlArDir()!!}  >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{!! SEO::generate() !!}
    <link rel="stylesheet" href="{{ defWebAssets('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/Main_Style.css') }}">
    <link rel="stylesheet" href="{{ defWebAssets('css/Main_Style_'.thisCurrentLocale().'.css') }}">

</head>
<body>


<div class="container">
    @include('web.layouts.inc.top_navbar')
</div>

<div class="container main-container">
    @yield('content')

</div>



@include('web.layouts.inc.footer')


<script src="{{ defWebAssets('jquery-3.7.0.min.js') }}" ></script>
<script src="{{ defWebAssets('bootstrap.bundle.min.js') }}"></script>
</body>
</html>
