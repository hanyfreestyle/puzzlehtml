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
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"fas fa-volleyball-ball",'photo'=>"images/amenity/playgrounds.webp",'photo_thum_1'=>"images/amenity/playgrounds_0.webp"],
            ['icon'=>"fas fa-swimming-pool",'photo'=>"images/amenity/swimming-pools.webp",'photo_thum_1'=>"images/amenity/swimming-pools_0.webp"],
            ['icon'=>"fas fa-shopping-cart",'photo'=>"images/amenity/shopping-center.webp",'photo_thum_1'=>"images/amenity/shopping-center_0.webp"],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"images/amenity/social-club.webp",'photo_thum_1'=>"images/amenity/social-club_0.webp"],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
            ['icon'=>"",'photo'=>"",'photo_thum_1'=>""],
        ];

        $countData =  Amenity::all()->count();
        if($countData == '0'){
            foreach ($data as $key => $value){
                Amenity::create($value);
            }
        }

    }
}
