<?php

namespace Database\Seeders;

use App\Models\admin\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            'icon'=>"fa fa-home",
        ];
        $countData =  Amenity::all()->count();
        if($countData == '0'){
            Amenity::create($data);
        }
    }
}
