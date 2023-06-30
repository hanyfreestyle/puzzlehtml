<?php

namespace Database\Seeders\config;

use App\Models\admin\config\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            'icon'=>"",
        ];
        $countData =  Amenity::all()->count();
        if($countData == '0'){
            for ($i = 1; $i <=14; $i++) {
                Amenity::create($data);
            }
        }
    }
}
