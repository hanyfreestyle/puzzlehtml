<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Amenitable;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Location;
use Illuminate\Http\Request;

class UpdateProjectController extends Controller
{


    public function index()
    {

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where("check_data","=",1)
            ->with('getoldtools')
            ->limit(100)
            ->get();


        foreach ($Projects as $project)
        {

            $unitstoProject = Listing::where('parent_id' , '=', $project->id)
                ->where('property_type','!=',null)
                ->get();

            if(count($unitstoProject) > 0){
                foreach ( $unitstoProject as $unit)
                {
                    $unit->location_id = $project->location_id;
                    $unit->developer_id = $project->developer_id;
                    $unit->save();

                }
            }
            $project->check_data = 2 ;
            $project->save();

        }

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where("check_data","=",1)
            ->with('getoldtools')
            ->count();

        echobr($Projects);



    }

    public function UpdateEmptyForSale()
    {

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where("check_data","=",1)
            ->where("test_location","=",1)
            ->where("test_developer","=",0)
            ->get();

        echobr("all ".count($Projects));

//        foreach ($Projects as $project)
//        {
//            echobr($project->id);
//            echobr($project->developer_id);
//            echobr('hr');
//
//            $project->developer_id = 331 ;
//            $project->save() ;
//
//
//        }


    }
    public function UpdateForSale()
    {
        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where("check_data","=",0)
            ->with('getoldtools')
            ->limit(100)
            ->get();




        if(count($Projects) > 0 ){
            foreach ($Projects as $project)
            {
                if(count($project->getoldtools) > 0){
                    $savedataAm = "[";
                    foreach ( $project->getoldtools as $item){
                        $savedataAm .= '"'.$item->amenity_id.'",' ;
                    }
                    $savedataAm =  substr($savedataAm, 0, -1);
                    $savedataAm .= "]";
                    $project->amenity = $savedataAm ;
                }
                $test_location = Location::where('id','=',$project->location_id)->count();
                $test_developer = Developer::where('id','=',$project->developer_id)->count();

                $project->test_location = $test_location ;
                $project->test_developer = $test_developer ;
                $project->check_data = 1 ;
                $project->save() ;

            }
        }



        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where("check_data","=",0)
            ->count();

        echobr($Projects);


    }


    public function UpdateEmptyProject()
    {

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where("check_data","=",1)
            ->where("test_location","=",1)
            ->where("test_developer","=",1)
            ->get();

        echobr("all ".count($Projects));

//        foreach ($Projects as $project)
//        {
//            echobr($project->id);
//            echobr($project->developer_id);
//            echobr('hr');
//
//            $project->developer_id = 331 ;
//            $project->save() ;
//
//
//        }





    }
    public function UpdateProjectAm()
    {

        #UpdateProjectAm
        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where("check_data","=",0)
            ->with('getoldtools')
            ->limit(100)
            ->get();


        if(count($Projects) > 0 ){
            foreach ($Projects as $project)
            {
                if(count($project->getoldtools) > 0){
                    $savedataAm = "[";
                    foreach ( $project->getoldtools as $item){
                        $savedataAm .= '"'.$item->amenity_id.'",' ;
                    }
                    $savedataAm =  substr($savedataAm, 0, -1);
                    $savedataAm .= "]";
                    $project->amenity = $savedataAm ;
                }
                $test_location = Location::where('id','=',$project->location_id)->count();
                $test_developer = Developer::where('id','=',$project->developer_id)->count();

                $project->test_location = $test_location ;
                $project->test_developer = $test_developer ;
                $project->check_data = 1 ;
                $project->save() ;

            }
        }

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->where("check_data","=",0)
            ->count();

        echobr($Projects);
    }

    public function DeleteOld_Data(){
         $ListTools = Amenitable::query()
         ->where('amenitable_type',"=","App\Location")
         ->count();

         echobr($ListTools);


        Amenitable::where('amenitable_type',"=","App\Location")->delete();


         $ListTools = Amenitable::query()
             ->where('amenitable_type',"=","App\Location")
             ->count();

         echobr($ListTools);


     }

}
