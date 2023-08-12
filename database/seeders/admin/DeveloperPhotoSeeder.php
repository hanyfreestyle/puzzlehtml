<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\DeveloperPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class DeveloperPhotoSeeder extends Seeder
{


    public function run(): void
    {

//        $old_Developer = DB::connection('mysql2')->table('developer_photos')->get();
//        foreach ($old_Developer as $oneDeveloper)
//        {
//            $data = [
//                'id'=>$oneDeveloper->id ,
//                'developer_id'=>$oneDeveloper->developer_id ,
//                'photo'=>$oneDeveloper->photo ,
//                'file_extension'=>$oneDeveloper->file_extension ,
//                'file_size'=>$oneDeveloper->file_size ,
//
//                'created_at'=>$oneDeveloper->created_at ,
//                'deleted_at'=>$oneDeveloper->deleted_at ,
//                'updated_at'=>$oneDeveloper->updated_at  ,
//            ];
//            DeveloperPhoto::create($data);
//        }


//        DeveloperPhoto::unguard();
//        $tablePath = public_path('db/developer_photos.sql');
//        DB::unprepared(file_get_contents($tablePath));

    }
}
