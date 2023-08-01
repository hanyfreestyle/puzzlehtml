<?php

namespace Database\Seeders\admin;

use App\Models\admin\Developer;
use App\Models\admin\Location;
use App\Models\admin\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

/*
        $old_Location = DB::connection('mysql2')->table('locations')->get();
        foreach ($old_Location as $oneLocation)
        {
            $data = [
                'id'=>$oneLocation->id ,
                'slug'=>$oneLocation->slug ,
                'parent_id'=>$oneLocation->parent_id ,
                'sort_order'=>$oneLocation->sort_order ,
                'latitude'=>$oneLocation->latitude ,
                'longitude'=>$oneLocation->longitude ,
                'projects_type'=>$oneLocation->projects_type ,
                'is_active'=>$oneLocation->is_active ,
                'is_searchable'=>$oneLocation->is_searchable ,

                'created_at'=>$oneLocation->created_at ,
                'updated_at'=>$oneLocation->updated_at  ,
                'deleted_at'=>$oneLocation->deleted_at  ,
            ];

            Location::create($data);
        }


        $location = Location::findOrFail(4);
        $location->parent_id = 7 ;
        $location->save();

        $location = Location::findOrFail(5);
        $location->parent_id = 7 ;
        $location->save();

        $locationList = Location::all();
        foreach ($locationList as $locationx){
            $old_Location = DB::connection('mysql2')->table('images')
                ->where('imageable_type','=',"App\Location")
                ->where('imageable_id',"=",$locationx->id)
                ->get();
            if(count($old_Location) == '1'){
                $updatelocation = Location::findOrFail($locationx->id);
                $updatelocation->photo = $old_Location->first()->image_url;
                $updatelocation->photo_thum_1 = $old_Location->first()->thumb_url;
                $updatelocation->save();
            }
        }
*/



//        $old_Location = DB::connection('mysql2')->table('backup_locations')->get();
//        foreach ($old_Location as $oneLocation)
//        {
//            $data = [
//
//                'id'=>$oneLocation->id ,
//                'slug'=>$oneLocation->slug ,
//                'parent_id'=>$oneLocation->parent_id ,
//                'sort_order'=>$oneLocation->sort_order ,
//                'latitude'=>$oneLocation->latitude ,
//                'longitude'=>$oneLocation->longitude ,
//                'projects_type'=>$oneLocation->projects_type ,
//
//                'photo'=>$oneLocation->photo ,
//                'photo_thum_1'=>$oneLocation->photo_thum_1 ,
//                'is_active'=>$oneLocation->is_active ,
//                'is_searchable'=>$oneLocation->is_searchable ,
//
//                'created_at'=>$oneLocation->created_at ,
//                'deleted_at'=>$oneLocation->deleted_at ,
//                'updated_at'=>$oneLocation->updated_at  ,
//            ];
//            Location::create($data);
//        }
//
//
//        $location = Location::findOrFail(4);
//        $location->parent_id = 7 ;
//        $location->save();
//
//        $location = Location::findOrFail(5);
//        $location->parent_id = 7 ;
//        $location->save();

        Location::unguard();
        $tablePath = public_path('db/locations.sql');
        DB::unprepared(file_get_contents($tablePath));

        $location = Location::findOrFail(4);
        $location->parent_id = 7 ;
        $location->save();

        $location = Location::findOrFail(5);
        $location->parent_id = 7 ;
        $location->save();

    }
}
