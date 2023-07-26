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
        $old_DeveloperTranslations = DB::connection('mysql2')->table('listing_translations')
            ->where('deleted_at','=',null)
            ->where('listing_id','!=','30235')
            ->limit(1000000000)->get();
        foreach ($old_DeveloperTranslations as $old_Developer)
        {
            $data = [
                'listing_id'=> $old_Developer->listing_id ,
                'locale'=> $old_Developer->locale ,
                'name'=> $old_Developer->title  ,
                'des'=> $old_Developer->description ,
                'g_des'=> $old_Developer->meta_description ,
                'g_title'=> $old_Developer->title ,
            ];
            ListingTranslation::create($data);
        }
    }
}
