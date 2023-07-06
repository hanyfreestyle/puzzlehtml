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
            ['filter_id'=>"2",'type'=>"4",'new_w'=>"150",'new_h'=>"150"],
            ['filter_id'=>"3",'type'=>"5",'new_w'=>"800",'new_h'=>"600",'canvas_back'=>'#FFFF00'],
            ['filter_id'=>"3",'type'=>"5",'new_w'=>"400",'new_h'=>"300",'canvas_back'=>'#07A424'],

        ];


        $countData =  UploadFilterSize::all()->count();
        if($countData == '0'){
            foreach ($addData as $key => $value){
                UploadFilterSize::create($value);
            }
        }

    }
}
