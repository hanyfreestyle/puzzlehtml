<?php

namespace Database\Seeders\config;

use App\Models\admin\config\MetaTagTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB ;

class MetaTagTranslationsTableSeeder extends Seeder
{

    public function run(): void
    {

//        $data_ar = [
//            'meta_tag_id'=>"1",
//            'locale'=>"ar",
//            'g_title'=>"الصفحة الرئيسة",
//            'g_des'=>"وصف الصفحة الرئيسية",
//            'body_h1'=>"الصفحة الرئيسية H1",
//            'breadcrumb'=>"وسام الصفحة الرئيسية",
//        ];
//
//        $data_en = [
//            'meta_tag_id'=>"1",
//            'locale'=>"en",
//            'g_title'=>"Home Page",
//            'g_des'=>"Home Description ",
//            'body_h1'=>"Home h1 tag",
//            'breadcrumb'=>"Home breadcrumb",
//        ];
//
//        $countData =  MetaTagTranslation::all()->count();
//        if($countData == '0'){
//            MetaTagTranslation::create($data_ar);
//            MetaTagTranslation::create($data_en);
//        }

        MetaTagTranslation::unguard();
        $tablePath = public_path('db/meta_tag_translations.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
