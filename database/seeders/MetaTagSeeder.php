<?php

namespace Database\Seeders;

use App\Models\admin\MetaTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'cat_id'=>"home",
        ];
        $countData =  MetaTag::all()->count();
        if($countData == '0'){
            MetaTag::create($data);
        }
    }
}
