<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\SettingFormRequest;
use App\Models\admin\Setting;
use App\Models\TestSetting;
use App\Models\User;
use Illuminate\Http\Request;


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
        Setting::where('id','1')->update([
            'facebook'=> $request->facebook,
            'twitter'=> $request->twitter,
            'youtube'=> $request->youtube,
            'instagram'=> $request->instagram,
            'google_api'=> $request->google_api,
        ]);
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
