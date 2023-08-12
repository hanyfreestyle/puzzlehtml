<?php

namespace App\Http\Controllers;

use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Listing;
use App\Models\admin\Post;
use App\Models\admin\PostLoction;
use App\Models\admin\PostTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateDataController extends Controller
{
    public function index()
    {

//        $Developers =  Developer::onlyTrashed()->get();
//        foreach ($Developers as $Developer)
//        {
//            $Developer->forceDelete();
//        }

//        $Developers = Developer::where('slug_count',null)->get();
//        if(count($Developers) > 0){
//            foreach ($Developers as $Developer)
//            {
//                $getCount = Developer::where('slug',$Developer->slug)->count();
//                $Developer->slug_count  =  $getCount;
//                $Developer->save();
//            }
//        }


//        $Developers =  Developer::all();
//        foreach ($Developers as $Developer)
//        {
//            $Developer->forceDelete();
//        }




    }



    public function index_Old()
    {


//        $Posts =  Post::onlyTrashed()->get();
//        foreach ($Posts as $Post)
//        {
//            $Post->forceDelete();
//        }




//
//        $Developers =  Post::query()
////            ->where('id',1421)
////            ->limit(1)
//            ->get();
//        ;
//
//





//        $Developers =  Developer::query()
//            ->where('id',13)
//            ->limit(1)
//            ->get();
//        ;
//        foreach ($Developers as $Developer)
//        {
//            echobr($Developer->id);
//            $projects_count = Listing::Project()->where('developer_id',$Developer->id)->count();
//            $units_count = Listing::Unit()->where('developer_id',$Developer->id)->count();
//            echobr($projects_count);
//            echobr($units_count);
//
//            $Developer->projects_count = $projects_count ;
//            $Developer->units_count = $units_count ;
//            $Developer->save() ;
//
//
//        }


//
//        $locs = PostLoction::all();
//
//
//        foreach ($locs as $lo){
//            $count = PostLoction::query()
//                ->where('post_id',$lo->post_id)
//                ->count();
//            ;
//
//            echobr($count);
//        }






    }




}
