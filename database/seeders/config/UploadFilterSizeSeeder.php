<?php

namespace Database\Seeders\config;

use App\Models\admin\config\UploadFilterSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UploadFilterSizeSeeder extends Seeder
{

    public function run(): void
    {

        $addData = [
            ['filter_id'=>"2",'type'=>"4",'new_w'=>"500",'new_h'=>"335"],
            ['filter_id'=>"4",'type'=>"4",'new_w'=>"40",'new_h'=>"40"],
            ['filter_id'=>"5",'type'=>"4",'new_w'=>"800",'new_h'=>"600",'canvas_back'=>'#ffffff'],
            ['filter_id'=>"5",'type'=>"4",'new_w'=>"320",'new_h'=>"240",'canvas_back'=>'#ffffff'],
        ];


        $countData =  UploadFilterSize::all()->count();
        if($countData == '0'){
            foreach ($addData as $key => $value){
                UploadFilterSize::create($value);
            }
        }

    }
}
