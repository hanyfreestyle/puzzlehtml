<?php

namespace Database\Seeders\config;


use App\Models\admin\config\DefPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB ;

class DefPhotoSeeder extends Seeder
{

    public function run(): void
    {

//        $data = [
//            ['cat_id'=>"logo",'photo'=>"images/def-photo/logo.webp",'photo_thum_1'=>"",'postion'=>'6'],
//            ['cat_id'=>"logo_2",'photo'=>"images/def-photo/logo-2.webp",'photo_thum_1'=>"",'postion'=>'5'],
//            ['cat_id'=>"project",'photo'=>"images/def-photo/project.webp",'photo_thum_1'=>"images/def-photo/project_0.webp",'postion'=>'1'],
//            ['cat_id'=>"latest-news",'photo'=>"images/def-photo/latest-news.webp",'photo_thum_1'=>"images/def-photo/latest-news_0.webp",'postion'=>'2'],
//            ['cat_id'=>"district",'photo'=>"images/def-photo/district.webp",'photo_thum_1'=>"images/def-photo/district_0.webp",'postion'=>'3'],
//            ['cat_id'=>"plan",'photo'=>"images/def-photo/plan.webp",'photo_thum_1'=>"images/def-photo/plan_0.webp",'postion'=>'4'],
//        ];
//
//        $countData =  DefPhoto::all()->count();
//        if($countData == '0'){
//            foreach ($data as $key => $value){
//                DefPhoto::create($value);
//            }
//        }

        DefPhoto::unguard();
        $tablePath = public_path('db/config_def_photos.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
