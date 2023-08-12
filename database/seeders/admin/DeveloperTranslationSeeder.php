<?php

namespace Database\Seeders\admin;

use App\Models\admin\DeveloperTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class DeveloperTranslationSeeder extends Seeder
{

    public function run(): void
    {

//        $old_DeveloperTranslations = DB::connection('mysql2')->table('developer_translations')->get();
//        foreach ($old_DeveloperTranslations as $old_Developer)
//        {
//
//            /*
//                            if($old_Developer->meta_description == null and  $old_Developer->description != null){
//
//                                $g_des = strip_tags($old_Developer->description) ;
//                                $g_des = str_replace('&nbsp;', ' ', $g_des);
//                                $g_des = trim(preg_replace('/[\t\n\r\s]+/', ' ', $g_des)) ;
//                                $g_des = Str::limit($g_des,160,"");
//
//
//                            }else{
//                                $g_des = $old_Developer->meta_description ;
//                            }
//            */
//
//            $data = [
//                'developer_id'=> $old_Developer->developer_id ,
//                'locale'=> $old_Developer->locale ,
//                'name'=> $old_Developer->name  ,
//                'des'=> $old_Developer->description ,
//                'g_des'=>$old_Developer->meta_description  ,
//                'g_title'=> $old_Developer->name ,
//            ];
//
//
//            DeveloperTranslation::create($data);
//        }


        DeveloperTranslation::unguard();
        $tablePath = public_path('db/developer_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }



}
