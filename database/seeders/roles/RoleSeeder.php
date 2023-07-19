<?php

namespace Database\Seeders\roles;

use App\Models\admin\config\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $data = [
            ['name' => 'editor','name_ar'=>'محرر','name_en'=>'editor'],
        ];


        $countData =  Role::all()->count();
        if($countData == '1'){
            foreach ($data as $key => $value){
                Role::create($value);
            }
        }


    }





}
