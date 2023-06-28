<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminHelper{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     thisCurrentLocale
    public static function thisCurrentLocale(){
        return LaravelLocalization::getCurrentLocale();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       detectFlag
    public static function detectFlag($regional){
        $data = [];
        if (!empty($regional)) {
            $regional = Str::lower($regional);
            $regional = explode("_", $regional);
            $data['flagName'] = $regional[1];
            $data['flagIcon'] = '<i class="flag-icon flag-icon-' . $data['flagName'] . '  mr-2"></i>';
        } else {
            $data['flagIcon'] = '<i class="flag-icon flag-icon-' . 'eg' . '  mr-2"></i>';
        }
        #return $flagIcon;
        return $data;
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     returnPageDate
    public static function returnPageDate($controllerName,$prefix='admin.'){
        $data = [];
        $data['ControllerName'] = $controllerName;
        $data['TitlePage'] = __($prefix.($controllerName) . '.main.title');

        $data['ListPageName'] = __($prefix.($controllerName) . '.main.listPage');
        $data['ListPageUrl'] = route(($controllerName) . '.index');


        $data['AddPageName'] = __($prefix.($controllerName) . '.main.addPage');
        $data['AddPageUrl'] = route(($controllerName) . '.create');


        $data['EditPageName'] = __($prefix.($controllerName) . '.main.editPage');

        return $data;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     error
    public static function error($value, $name, $label){
        $newName = trim(str_replace('_', " ", $name));
        return str_replace($newName, $label, $value);
    }

}
