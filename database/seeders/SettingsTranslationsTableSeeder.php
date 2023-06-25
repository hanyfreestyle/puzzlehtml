<?php

namespace Database\Seeders;


use App\Models\admin\SettingTranslation;
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
            'name'=>"الاسم",
            'g_title'=>"العنوان",
            'g_des'=>"الوصف",
            'closed_mass'=>"رسالة الاغلاق",
        ];

        $setting_en = [
            'setting_id'=>"1",
            'locale'=>"en",
            'name'=>"name",
            'g_title'=>"g_title",
            'g_des'=>"g_des",
            'closed_mass'=>"closed_mass",
        ];

        $countSetting =  SettingTranslation::all()->count();
        if($countSetting == '0'){
            SettingTranslation::create($setting_ar);
            SettingTranslation::create($setting_en);
        }

    }
}
