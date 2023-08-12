<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Location;
use App\Models\admin\Post;
use App\Models\admin\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{

    public function run(): void
    {


//        $old_Developer = DB::connection('mysql2')->table('developers')->get();
//        foreach ($old_Developer as $oneDeveloper)
//        {
//            $data = [
//                'id'=>$oneDeveloper->id ,
//                'slug'=>$oneDeveloper->slug ,
//                'slider_images_dir'=>$oneDeveloper->slider_images_dir ,
//                'projects_count'=>$oneDeveloper->projects_count ,
//                'is_active'=>$oneDeveloper->is_active ,
//                'created_at'=>$oneDeveloper->created_at ,
//                'deleted_at'=>$oneDeveloper->deleted_at ,
//                'updated_at'=>$oneDeveloper->updated_at  ,
//            ];
//            Developer::create($data);
//        }
//
//
//        $Developer_List = Developer::all();
//        foreach ($Developer_List as $Developer_is){
//            $old_Developer = DB::connection('mysql2')->table('images')
//                ->where('imageable_type','=',"App\Developer")
//                ->where('imageable_id',"=",$Developer_is->id)
//                ->get();
//
//            if(count($old_Developer) == '1'){
//                $Update = Developer::findOrFail($Developer_is->id);
//                $Update->photo = $old_Developer->first()->image_url;
//                $Update->photo_thum_1 = $old_Developer->first()->thumb_url;
//                $Update->save();
//            }
//        }

        Developer::unguard();
        $tablePath = public_path('db/developers.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
