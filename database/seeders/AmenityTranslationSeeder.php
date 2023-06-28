<?php

namespace Database\Seeders;

use App\Models\admin\AmenityTranslation;
use Illuminate\Database\Seeder;

class AmenityTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_ar = [
            'amenity_id'=>"1",
            'locale'=>"ar",
            'name'=>"الرئيسية",
        ];

        $data_en = [
            'amenity_id'=>"1",
            'locale'=>"en",
            'name'=>"Home",
        ];
        $countData =  AmenityTranslation::all()->count();
        if($countData == '0'){
            AmenityTranslation::create($data_ar);
            AmenityTranslation::create($data_en);
        }
    }
}
