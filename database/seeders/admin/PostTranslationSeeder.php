<?php

namespace Database\Seeders\admin;


use App\Models\admin\PostTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PostTranslationSeeder extends Seeder
{

    public function run(): void
    {


//        $old_PostTranslations = DB::connection('mysql2')->table('post_translations')->get();
//        foreach ($old_PostTranslations as $old_Post)
//        {
//            $data = [
//                'post_id'=> $old_Post->post_id ,
//                'locale'=> $old_Post->locale ,
//                'name'=> $old_Post->title  ,
//                'des'=> $old_Post->content ,
//                'g_des'=> $old_Post->meta_description ,
//            ];
//            PostTranslation::create($data);
//        }

        PostTranslation::unguard();
        $tablePath = public_path('db/post_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
