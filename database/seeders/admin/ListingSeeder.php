<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\Listing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ListingSeeder extends Seeder
{


    public function run(): void
    {
       // $old_listing = DB::connection('mysql2')->table('listings')->get();
        $old_listing = DB::connection('mysql2')->table('listings')->limit(50000)->get();
        foreach ($old_listing as $oneListing)
        {
            $data = [
                'id'=>$oneListing->id ,
                'parent_id'=>$oneListing->parent_id ,
                'location_id'=>$oneListing->location_id ,
                'developer_id'=>$oneListing->developer_id ,

                'slug'=>$oneListing->slug ,
                'slider_images_dir'=>$oneListing->slider_images_dir ,
                'youtube_url'=>$oneListing->youtube_url ,
                'price'=>$oneListing->price ,
                'contact_number'=>$oneListing->contact_number ,

                'area'=>$oneListing->area ,
                'baths'=>$oneListing->baths ,
                'rooms'=>$oneListing->rooms ,

                'status'=>$oneListing->status ,
                'project_type'=>$oneListing->project_type ,
                'property_type'=>$oneListing->property_type ,
                'view'=>$oneListing->view ,

                'latitude'=>$oneListing->latitude ,
                'longitude'=>$oneListing->longitude ,
                'delivery_date'=>$oneListing->delivery_date ,

                'is_published'=>$oneListing->is_published ,
                'is_featured'=>$oneListing->is_featured ,
                'published_at'=>$oneListing->published_at ,

                'created_at'=>$oneListing->created_at ,
                'deleted_at'=>$oneListing->deleted_at ,
                'updated_at'=>$oneListing->updated_at  ,


            ];
            Listing::create($data);
        }

    }
}
