<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Models\admin\Listing;
use App\Models\admin\ListingTranslation;
use App\Models\admin\Location;
use App\Models\admin\Post;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
     public function index(){

          self::PrintData();

     }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PrintData
    public function PrintData(){
        $All = Listing::withTrashed()->count();
        echobr("All : ".$All);

        $Trashed = Listing::onlyTrashed()->count();
        echobr("Trashed : ".$Trashed);

        $Active = Listing::get()->count();
        echobr("Active : ".$Active);

//         $un_published = Listing::where('is_published' , '=', 0 )->count();
//         echobr("Un Published : ".$un_published);
//
//         $is_published = Listing::where('is_published' , '=', 1 )->count();
//         echobr("Published : ".$is_published);

        $project = Listing::withTrashed()->where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->count();
        echobr("Project : ".$project);


        $Units = Listing::withTrashed()->where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->count();
        echobr("Units : ".$Units);


        $UnitsToProject = Listing::withTrashed()->where('parent_id' , '!=', null )
            ->count();
        echobr("Units To Project : ".$UnitsToProject);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Remove_parent_id
    public function  Remove_parent_id(){
        # Remove parent_id
        $count = 0 ;
        $listings =  Listing::withTrashed()->get();
        foreach ($listings as $list){
            if( $list->id == $list->parent_id ){
                $count++;
            }
        }
        echobr($count);


        $listings =  Listing::withTrashed()->get();
        foreach ($listings as $list){
            if( $list->id == $list->parent_id ){
                $update = Listing::withTrashed()->where('id','=',$list->id)->first();
                $update->parent_id = null;
                $update->save();
            }
        }
        echobr('hr');

        $count = 0 ;
        $listings =  Listing::withTrashed()->get();
        foreach ($listings as $list){
            if( $list->id == $list->parent_id ){
                $count++;
            }
        }
        echobr($count);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     DeleteTrashed
    public function DeleteTrashed(){
        $Trashed = Listing::onlyTrashed()->get();
        foreach ($Trashed as  $item){

            $sub =  Listing::withTrashed()->where('parent_id','=',$item->id)->get();
            if(count($sub) > 0){
                foreach ($sub as $hany){
                    $deletesub =  Listing::withTrashed()->where('id',$hany->id)->first();
                    $deletesub->forceDelete();
                }
            }
            $deleteRow =  Listing::onlyTrashed()->where('id',$item->id)->first();
            $deleteRow->forceDelete();
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
}
