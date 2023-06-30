<?php

namespace Database\Seeders\config;


use App\Models\admin\config\SettingTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting_ar = [
            'setting_id'=>"1",
            'locale'=>"ar",
            'name'=>"اسم الموقع يكتب هنا",
            'g_title'=>"عنوان الصفحة يكتب هنا",
            'g_des'=>"وصف الصفحة يكتب هنا",
            'closed_mass'=>"رسالة الاغلاق تكتب هنا",
        ];

        $setting_en = [
            'setting_id'=>"1",
            'locale'=>"en",
            'name'=>"The name of the site is written here",
            'g_title'=>"The title of the site is written here",
            'g_des'=>"The description of the site is written here",
            'closed_mass'=>"The closed mass of the site is written here ",
        ];

        $countSetting =  SettingTranslation::all()->count();
        if($countSetting == '0'){
            SettingTranslation::create($setting_ar);
            SettingTranslation::create($setting_en);
        }
    }
}
