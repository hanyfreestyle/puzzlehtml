<?php

namespace Database\Seeders\admin;

use App\Models\admin\LocationTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LocationTranslationSeeder extends Seeder
{

    public function run(): void
    {

//        $old_LocationTranslations = DB::connection('mysql2')->table('location_translations')->get();
//        foreach ($old_LocationTranslations as $oneLocation)
//        {
//            $data = [
//                'location_id'=> $oneLocation->location_id ,
//                'locale'=> $oneLocation->locale ,
//                'name'=> $oneLocation->name ,
//                'g_des'=> $oneLocation->meta_description ,
//                'des'=> $oneLocation->description ,
//            ];
//            LocationTranslation::create($data);
//        }


        LocationTranslation::unguard();
        $tablePath = public_path('db/location_translations.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
