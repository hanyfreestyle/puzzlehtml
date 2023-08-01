<?php

namespace Database\Seeders\admin;

use App\Models\admin\Category;
use App\Models\admin\CategoryTranslation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategoryTranslationSeeder extends Seeder
{

    public function run(): void
    {

//        $old_CategoryTranslations = DB::connection('mysql2')->table('category_translations')->get();
//        foreach ($old_CategoryTranslations as $oneCategory)
//        {
//            $data = [
//                'category_id'=> $oneCategory->category_id ,
//                'locale'=> $oneCategory->locale ,
//                'name'=> $oneCategory->name ,
//                'g_des'=> $oneCategory->meta_description ,
//            ];
//            CategoryTranslation::create($data);
//        }


        CategoryTranslation::unguard();
        $tablePath = public_path('db/category_translations.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
