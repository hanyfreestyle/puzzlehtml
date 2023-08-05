<nav class="lang py-2 mb-2" >
    <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(), null, [], true) }}">{{webChangeLocaletext()}}</a>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{route('menu-home')}}">{{__('web/.menu_home')}}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('menu-blog')}}">{{ __('web/.menu_blog') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('menu-developers')}}">{{ __('web/.menu_developer') }}</a>
            </li>


{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">{{ __('web/.menu_loaction') }}</a>--}}
{{--            </li>--}}

            <li class="nav-item">
                <a class="nav-link" href="{{route('menu-contact-us')}}">{{ __('web/.menu_contatc_us') }}</a>
            </li>


{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Dropdown link--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Another action</a>--}}
{{--                    <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                </div>--}}
{{--            </li>--}}

        </ul>
    </div>
</nav>




