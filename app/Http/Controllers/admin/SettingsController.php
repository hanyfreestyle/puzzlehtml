<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SettingFormRequest;
use App\Models\admin\Setting;
use App\Models\admin\SettingTranslation;
use App\Models\TestSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;


class SettingsController extends Controller
{


    public function webConfigEdit(){
        $setting = Setting::findOrFail(1);

        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin/menu.setting.config.web'),
        ];

        return view('admin.setting.settingWeb')
            ->with(compact('pageData'))
            ->with(compact('setting'));

    }

    public function webConfigUpdate(SettingFormRequest $request){
        $request-> validated();

        //dd($request->all());

        $setting= Setting::findorfail('1');
        $setting->update($request->all());



/*
        Setting::where('id','1')->update([

            'facebook'=> $request->facebook,
            'twitter'=> $request->twitter,
            'youtube'=> $request->youtube,
            'instagram'=> $request->instagram,
            'google_api'=> $request->google_api,
        ]);

*/



/*

        $saveData =  Setting::findOrNew(1) ;
        $saveData->facebook = $request->facebook;
        $saveData->twitter = $request->twitter;
        $saveData->youtube = $request->youtube;
        $saveData->instagram = $request->instagram;
        $saveData->google_api = $request->google_api;
        $saveData->save();

        foreach ( config('app.lang_file') as $localeCode => $properties) {
            $saveTranslation = SettingTranslation::where('setting_id','1')->where('locale',$localeCode)
                ->firstOrNew();
            $saveTranslation->title = $request->$localeCode['title'];
            $saveTranslation->save();
        }
*/
        return redirect(route('admin.config.web'));
    }


    public function index()
    {
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin/menu.setting.config.web'),
        ];
        return view('admin.setting.settingWeb')
            ->with(compact('pageData'));

    }
}
