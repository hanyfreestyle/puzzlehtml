<?php

namespace Database\Seeders\config;

use App\Models\admin\config\AmenityTranslation;
use Illuminate\Database\Seeder;

class AmenityTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_ar = [
            ['amenity_id'=>"1",'locale'=>"ar",'name'=>"حراسة"],
            ['amenity_id'=>"2",'locale'=>"ar",'name'=>"ملاعب"],
            ['amenity_id'=>"3",'locale'=>"ar",'name'=>"حمامات سباحة"],
            ['amenity_id'=>"4",'locale'=>"ar",'name'=>"مركز تجاري"],
            ['amenity_id'=>"5",'locale'=>"ar",'name'=>"منطقة تجارية"],
            ['amenity_id'=>"6",'locale'=>"ar",'name'=>"مسجد"],
            ['amenity_id'=>"7",'locale'=>"ar",'name'=>"نادي اجتماعي"],
            ['amenity_id'=>"8",'locale'=>"ar",'name'=>"نادي صحي و رياضي"],
            ['amenity_id'=>"9",'locale'=>"ar",'name'=>"نافورات مياه"],
            ['amenity_id'=>"10",'locale'=>"ar",'name'=>"فندق"],
            ['amenity_id'=>"11",'locale'=>"ar",'name'=>"اكوا بارك"],
            ['amenity_id'=>"12",'locale'=>"ar",'name'=>"سينما"],
            ['amenity_id'=>"13",'locale'=>"ar",'name'=>"غرفتين"],
            ['amenity_id'=>"14",'locale'=>"ar",'name'=>"2 حمام"],
        ];

        $data_en = [
            ['amenity_id'=>"1",'locale'=>"en",'name'=>"Security"],
            ['amenity_id'=>"2",'locale'=>"en",'name'=>"Playgrounds"],
            ['amenity_id'=>"3",'locale'=>"en",'name'=>"Swimming pools"],
            ['amenity_id'=>"4",'locale'=>"en",'name'=>"Shopping center"],
            ['amenity_id'=>"5",'locale'=>"en",'name'=>"Commercial area"],
            ['amenity_id'=>"6",'locale'=>"en",'name'=>"Mosque"],
            ['amenity_id'=>"7",'locale'=>"en",'name'=>"Social Club"],
            ['amenity_id'=>"8",'locale'=>"en",'name'=>"Health club and Spa"],
            ['amenity_id'=>"9",'locale'=>"en",'name'=>"Water Fountains"],
            ['amenity_id'=>"10",'locale'=>"en",'name'=>"Hotel"],
            ['amenity_id'=>"11",'locale'=>"en",'name'=>"Aqua park"],
            ['amenity_id'=>"12",'locale'=>"en",'name'=>"Cinema"],
            ['amenity_id'=>"13",'locale'=>"en",'name'=>"2 Bedrooms"],
            ['amenity_id'=>"14",'locale'=>"en",'name'=>"2 Bathrooms"],
        ];
        $countData =  AmenityTranslation::all()->count();
        if($countData == '0'){
            foreach ($data_ar as $key => $value){
                AmenityTranslation::create($value);
            }
            foreach ($data_en as $key => $value){
                AmenityTranslation::create($value);
            }
        }
    }
}
