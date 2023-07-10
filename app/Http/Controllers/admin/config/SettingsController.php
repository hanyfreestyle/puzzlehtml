<?php

namespace App\Http\Controllers\admin\config;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\SettingFormRequest;
use App\Models\admin\config\Setting;



class SettingsController extends AdminMainController
{


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigEdit
    public function webConfigEdit(){

        $setting = Setting::findOrFail(1);
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=>__('admin/menu.setting_web'),
        ];
        return view('admin.config.settingWeb')->with(compact('pageData','setting'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webConfigUpdate
    public function webConfigUpdate(SettingFormRequest $request){
        $request-> validated();
        if(isset($request->web_status)){
            $request['web_status'] = '1';
        }else{
            $request['web_status'] = '0';
        }

        #dd($request->all());

        $setting= Setting::findorfail('1');
        $setting->update($request->all());

        return  back()->with('Edit.Done',"");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text









}
