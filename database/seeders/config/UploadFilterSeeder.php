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
            ['name'=>"favIcon",'new_w'=>"40",'new_h'=>"40",'type'=>'4'],
            ['name'=>"Logo",'new_w'=>"300",'new_h'=>"300",'type'=>'4'],
            ['name'=>"PhotoGallery",'new_w'=>"1000",'new_h'=>"800",'type'=>'4'],
        ];

        $countData =  UploadFilter::all()->count();
        if($countData == '0'){
            foreach ($addData as $key => $value){
                UploadFilter::create($value);
            }
        }
    }
}
