<?php

namespace Database\Seeders\config;

use App\Models\admin\config\UploadFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UploadFilterSeeder extends Seeder
{

    public function run(): void
    {
        $addData = [
            ['name'=>"NoEdit",'new_w'=>"100",'new_h'=>"100",'type'=>'1','canvas_back'=>'#ffffff'],
            ['name'=>"DefPhoto",'new_w'=>"800",'new_h'=>"420",'type'=>'4','canvas_back'=>'#ffffff'],
            ['name'=>"FavIcon",'new_w'=>"40",'new_h'=>"40",'type'=>'4','canvas_back'=>'#ffffff'],
            ['name'=>"Amenity",'new_w'=>"80",'new_h'=>"80",'type'=>'4','canvas_back'=>'#ffffff'],
            ['name'=>"PhotoGallery",'new_w'=>"1024",'new_h'=>"768",'type'=>'4','canvas_back'=>'#ffffff'],
        ];

        $countData =  UploadFilter::all()->count();
        if($countData == '0'){
            foreach ($addData as $key => $value){
                UploadFilter::create($value);
            }
        }
    }
}
