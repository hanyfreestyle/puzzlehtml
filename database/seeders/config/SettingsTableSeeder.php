<?php

namespace Database\Seeders\config;

use App\Models\admin\config\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'web_url'=>"#",
            'web_status'=>"1",
            'logo'=>"",
            'favicon'=>"",
            'phone_num'=>"01221563252",
            'whatsapp_num'=>"201221563252",
            'facebook'=>"#",
            'youtube'=>"#",
            'twitter'=>"#",
            'instagram'=>"#",
            'google_api'=>"#",
        ];

        $countSetting =  Setting::all()->count();
        if($countSetting == '0'){
            Setting::create($settings);
        }
    }
}
