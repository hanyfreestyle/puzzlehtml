<?php

namespace Database\Seeders\admin;

use App\Models\admin\DeveloperTranslation;
use App\Models\admin\ListingTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ListingTranslationSeeder extends Seeder
{

    public function run(): void
    {
          ini_set('memory_limit', '512M');
//
//        $old_DeveloperTranslations = DB::connection('mysql2')->table('listing_translations')
//            ->where('deleted_at','=',null)
//            ->where('listing_id','!=','30235')
//            ->limit(10000000000000)->get();
//        foreach ($old_DeveloperTranslations as $old_Developer)
//        {
//            $data = [
//                'listing_id'=> $old_Developer->listing_id ,
//                'locale'=> $old_Developer->locale ,
//                'name'=> $old_Developer->title  ,
//                'des'=> $old_Developer->description ,
//                'g_des'=> $old_Developer->meta_description ,
//                'g_title'=> $old_Developer->title ,
//            ];
//            ListingTranslation::create($data);
//        }

        ListingTranslation::unguard();
        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_DataStructure.sql');
        DB::unprepared(file_get_contents($tablePath));


        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_1.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_2.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_3.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_4.sql');
        DB::unprepared(file_get_contents($tablePath));

        $tablePath = public_path('db/SQLDumpSplitterResult/listing_translations_5.sql');
        DB::unprepared(file_get_contents($tablePath));


    }
}
