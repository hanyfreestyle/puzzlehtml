<?php

namespace Database\Seeders;

use App\Models\admin\Category;
use App\Models\admin\CategoryTranslation;
use App\Models\admin\config\AmenityTranslation;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $old_CategoryTranslations = DB::connection('mysql2')->table('category_translations')->get();
        foreach ($old_CategoryTranslations as $oneCategory)
        {
            $data = [
                'category_id'=> $oneCategory->category_id ,
                'locale'=> $oneCategory->locale ,
                'name'=> $oneCategory->name ,
                'g_des'=> $oneCategory->meta_description ,
            ];
            CategoryTranslation::create($data);
        }

        /*
        $data_ar = [
            ['category_id'=>"1",'locale'=>"ar",'name'=>"حراسة"],
            ['category_id'=>"2",'locale'=>"ar",'name'=>"ملاعب"],
            ['category_id'=>"3",'locale'=>"ar",'name'=>"حمامات سباحة"],
        ];

        $data_en = [
            ['category_id'=>"1",'locale'=>"en",'name'=>"Security"],
            ['category_id'=>"2",'locale'=>"en",'name'=>"Playgrounds"],
            ['category_id'=>"3",'locale'=>"en",'name'=>"Swimming pools"],
        ];

        $countData =  CategoryTranslation::all()->count();
        if($countData == '0'){
            foreach ($data_ar as $key => $value){
                CategoryTranslation::create($value);
            }
            foreach ($data_en as $key => $value){
                CategoryTranslation::create($value);
            }
        }



        */
    }
}
