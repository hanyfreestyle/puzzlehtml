<?php

use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\File;

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
#|||||||||||||||||||||||||||||||||||||| #    static_admin_asset
if (!function_exists('defWebAssets')) {
    function defWebAssets($path, $secure = null): string
    {
        return app('url')->asset('assets/web/' . $path, $secure);
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    static_admin_asset
if (!function_exists('defImagesDir')) {
    function defImagesDir($path, $secure = null): string
    {
        return app('url')->asset( $path, $secure);
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
        switch ($val) {
            case 's':
                $sendStyle = "btn-sm";
                break;
            case 'm':
                $sendStyle = "btn-md";
                break;
            case 'l':
                $sendStyle = "btn-lg";
                break;

            default:
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
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getAlign
if (!function_exists('getAlign')) {
    function getAlign($val)
    {
        $sendStyle = "";
        if($val == 'c'){
            $sendStyle = "center";
        }elseif ($val == 'r'){
            $sendStyle = "right";
        }elseif ($val == 'l'){
            $sendStyle = "left";
        }
        return $sendStyle;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   printStateIcon
if (!function_exists('printStateIcon')) {
    function printStateIcon($chekVal,$sendArr=array())
    {
        if($chekVal == '1'){
            $icon = '<span class="text-success TableIcon"><i class="fas fa-check-square"></i></span>';
        }else{
            $icon = '<span class="text-danger TableIcon"><i class="fas fa-times"></i></span></span>';
        }
        return $icon ;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getColDir
if (!function_exists('getColDir')) {
    function getColDir($key,$sendArr=array())
    {
        $currentDir = "";
        if($key == 'ar' and thisCurrentLocale() == 'en'){
            $currentDir = ' order-last ';
        }
        return $currentDir ;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text
if (!function_exists('getTrans')) {
    function getTrans($key="")
    {
        $currentTrans = "hany";

        return $currentTrans ;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    thisCurrentLocale
if (!function_exists('getTransVar')) {
    function getTransVar(){
        if(thisCurrentLocale() == 'ar'){
            $sendName = "_ar";
        }else{
            $sendName = "";
        }
        return $sendName;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getRoleName

if (!function_exists('getRoleName')) {
    function getRoleName(){
        if(thisCurrentLocale() == 'ar'){
            $sendName = "name_ar";
        }else{
            $sendName = "name_en";
        }
        return $sendName;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text
if (!function_exists('echobr')) {
    function echobr($text=""){
        if($text ==  "hr"){
            $text = '<hr/>';
        }
        echo  $text."<br/>";
       // return $sendName;
    }
}


if (!function_exists('printProjectIconX')) {
    function printProjectIconX($name,$icon,$count,$sendArr=array()){

        $html = "";


        return $html;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text
if (!function_exists('Update_createDirectory')) {
    function Update_createDirectory($uploadDir){
       // $fullPath = public_path($uploadDir);
        $fullPath = $uploadDir;
        if(!File::isDirectory($fullPath)){
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir ;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    static_admin_asset
if (!function_exists('Update_defImagesDir')) {
    function Update_defImagesDir($path, $secure = null): string
    {
        return app('url')->asset( "ckfinder/userfiles/".$path, $secure);
    }
}








#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    thisCurrentLocale
if (!function_exists('webChangeLocale')) {
    function webChangeLocale(){
        $Current =  LaravelLocalization::getCurrentLocale() ;
        if($Current == 'ar'){
            $change = 'en';
        }else{
            $change = 'ar';
        }
        return $change;
    }
}

if (!function_exists('webChangeLocaletext')) {
    function webChangeLocaletext(){
        $Current =  LaravelLocalization::getCurrentLocale() ;
        if($Current == 'ar'){
            $change = 'English';
        }else{
            $change = 'عربى';
        }
        return $change;
    }
}


if (!function_exists('project_status')) {
    function project_status($getVal){

        if($getVal == 'under-construction'){
            $sendVal = 'تحت الانشاء';
        }else{
            $sendVal = 'اكتمل';
        }
        return $sendVal;
    }
}


if (!function_exists('getPhotoPath')) {
    function getPhotoPath($file,$defPhoto){
        $defPhoto_file = WebMainController::getDefPhotoById($defPhoto);
        if($file){
            $sendImg = defImagesDir($file);
        }else{
            $sendImg = defImagesDir($defPhoto_file->photo);
        }
        return $sendImg ;
    }
}






?>
