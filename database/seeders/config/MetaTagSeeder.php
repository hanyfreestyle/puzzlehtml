<?php

namespace Database\Seeders\config;


use App\Models\admin\config\MetaTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB ;

class MetaTagSeeder extends Seeder
{

    public function run(): void
    {
//        $data = [
//            'cat_id'=>"home",
//        ];
//        $countData =  MetaTag::all()->count();
//        if($countData == '0'){
//            MetaTag::create($data);
//        }

        MetaTag::unguard();
        $tablePath = public_path('db/meta_tags.sql');
        DB::unprepared(file_get_contents($tablePath));
    }
}
