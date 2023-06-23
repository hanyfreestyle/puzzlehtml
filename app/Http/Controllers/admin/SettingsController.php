<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
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
