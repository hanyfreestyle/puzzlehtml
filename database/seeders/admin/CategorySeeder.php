<?php

namespace Database\Seeders\admin;

use App\Models\admin\Category;
use DB ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {

//        $old_Category = DB::connection('mysql2')->table('categories')->get();
//        foreach ($old_Category as $oneCategory)
//        {
//            $data = [
//                'id'=>$oneCategory->id ,
//                'slug'=>$oneCategory->slug ,
//                'created_at'=>$oneCategory->created_at ,
//                'updated_at'=>$oneCategory->updated_at  ,
//                'is_active'=>$oneCategory->is_active ,
//            ];
//            Category::create($data);
//        }


        Category::unguard();
        $tablePath = public_path('db/categories.sql');
        DB::unprepared(file_get_contents($tablePath));

    }
}
