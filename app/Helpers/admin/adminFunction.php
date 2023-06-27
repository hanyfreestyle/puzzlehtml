<?php
if (!function_exists('getTrans')) {
    function getTrans($name)
    {
        return  "dddddddddddd";
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    static_admin_asset
if (!function_exists('defAdminAssets')) {
    function defAdminAssets($path, $secure = null): string
    {
        return app('url')->asset('assets/admin/' . $path, $secure);
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # mainBodyStyle
if (!function_exists('mainBodyStyle')) {
    function mainBodyStyle()
    {
        $sendStyle = "sidebar-mini ";
        if( config('adminConfig.sidebar_collapse_hide') == true){
            $sendStyle = ' ' ;
        }
        if( config('adminConfig.sidebar_collapse') == true){
            $sendStyle .= ' sidebar-collapse ' ;
        }
        if( config('adminConfig.sidebar_fixed') == true){
            $sendStyle .= ' layout-fixed ' ;
        }
        if( config('adminConfig.top_navbar_fixed') == true){
            $sendStyle .= ' layout-navbar-fixed ' ;
        }
        if( config('adminConfig.footer_fixed') == true){
            $sendStyle .= ' layout-footer-fixed ' ;
        }
        if( config('adminConfig.dark-mode') == true){
            $sendStyle .= ' dark-mode ' ;
        }
        if( config('adminConfig.pace_progress') == true){
            $sendStyle .= ' '.config('adminConfig.pace_progress_style').' ' ;
        }

        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # sideBarNavUlStyle
if (!function_exists('navBarStyle')) {
    function navBarStyle(){
        $sendStyle = " navbar-white ";
        if( config('adminConfig.top_navbar_dark') == true or config('adminConfig.dark-mode') == true ){
            $sendStyle = ' navbar-dark ' ;
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # sideBarNavUlStyle
if (!function_exists('sideBarNavUlStyle')) {
    function sideBarNavUlStyle(){
        $sendStyle = " ";
        if( config('adminConfig.sidebar_flat_style') == true){
            $sendStyle = ' nav-flat ' ;
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    openMenu
if (!function_exists('openMenu')) {
    function openMenu(array $routes, $output = "menu-open"){
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    areActiveRoutes
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active"){
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    thisCurrentLocale
if (!function_exists('thisCurrentLocale')) {
    function thisCurrentLocale(){
        return LaravelLocalization::getCurrentLocale();
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # htmlArDir
if (!function_exists('htmlArDir')) {
    function htmlArDir()
    {
        $sendStyle = ' dir="'.LaravelLocalization::getCurrentLocaleDirection().'" ' ;
        return $sendStyle;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getButSize
if (!function_exists('getButSize')) {
    function getButSize($val)
    {
        if($val == 's'){
            $sendStyle = "btn-sm";
        }else{
            $sendStyle = "btn-sm";
        }
        return $sendStyle;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getBgColor
if (!function_exists('getBgColor')) {
    function getBgColor($val)
    {
        switch ($val) {
            case 'def':
                $sendColor = "default";
                break;
            case 'dark':
                $sendColor = "dark";
                break;
            case 'p':
                $sendColor = "primary";
                break;
            case 'se':
                $sendColor = "secondary";
                break;
            case 's':
                $sendColor = "success";
                break;
            case 'i':
                $sendColor = "info";
                break;
              case 'd':
                $sendColor = "danger";
                break;
            case 'w':
                $sendColor = "warning";
                break;
            case 'l':
                $sendColor = "light";
                break;
            default:
                $sendColor = "dark";
        }
        return $sendColor;
    }
}


?>
