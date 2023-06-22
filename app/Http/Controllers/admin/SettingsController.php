<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.setting.settingWeb');
    }
}
