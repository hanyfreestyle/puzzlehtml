<?php

namespace App\Http\Controllers\admin\config;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\SettingFormRequest;
use App\Models\admin\config\Setting;
use Artisan;
use Cache;
use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;


class SettingsController extends AdminMainController
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:website_config', ['only' => ['webConfigEdit','webConfigUpdate']]);
    }

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
        $setting= Setting::findorfail('1');
        $setting->update($request->all());
        Cache::forget('WebConfig_Cash');

        return  back()->with('Edit.Done',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     defIconShow
    public function defIconShow(){
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin/menu.setting_icon'),
        ];

        return view('admin.config.defIcon_show')->with(compact('pageData'));

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     webConfigModel
public function webConfigModel(){

    // $valuestore = Valuestore::make(config_path(config('app.model_settings_name')));
   // $valuestore->put('facebook', 'www.facebook.com');
   // $setting =  $valuestore->all();


    $pageData =[
        'ViewType'=>"Page",
        'TitlePage'=>__('admin/menu.setting_model'),
    ];
    return view('admin.config.settingModel')->with(compact('pageData'));
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigModelUpdate
    public function webConfigModelUpdate(Request $request){


        $model_id = $request->input('model_id')."_";

        $this->validate($request, [
            $model_id.'perpage' => 'sometimes|required|integer|between:1,100',
            $model_id.'datatable' => 'sometimes|required',
            $model_id.'filterid' => 'sometimes|required',
            $model_id.'orderby' => 'sometimes|required',
        ]);



        $valuestore = Valuestore::make(config_path(config('app.model_settings_name')));
        foreach ($request->all()  as $key => $value){
            $valuestore->put($key, $value);
        }
        $valuestore->forget('_token');
        $valuestore->forget('B1');
        $valuestore->forget('model_id');

        return back();

    }


    public function clearCash()
    {
        Artisan::call('cache:clear');
        echobr('Application cache has been cleared');

//        Artisan::call('route:cache');
//        echobr('Routes cache has been cleared');

        Artisan::call('config:cache');
        echobr('Config cache has been cleared');

        Artisan::call('view:clear');
        echobr('View cache has been cleared');



    }

}
