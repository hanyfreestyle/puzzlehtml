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
//        foreach ($Developers as $rowData)
//        {
//            echobr($rowData->id);
//
//            $saveTranslation = PostTranslation::where('post_id', $rowData->id)->where('locale', 'ar')->firstOrNew();
//
//            if ($saveTranslation->g_title == null and $saveTranslation->name  != null)
//            {
//                $saveTranslation->g_title = $rowData->translate('ar')->name;
//                $saveTranslation->save();
//            }
//            $saveTranslation = PostTranslation::where('post_id', $rowData->id)->where('locale', 'en')->firstOrNew();
//            if ($saveTranslation->g_title == null and $saveTranslation->name  != null)
//            {
//                $saveTranslation->g_title = $rowData->translate('en')->name;
//                $saveTranslation->save();
//            }
//
//        }
//


//        $Developers =  Developer::query()
//            ->where('id',13)
//            ->limit(1)
//            ->get();
//        ;
//        foreach ($Developers as $rowData)
//        {
//            echobr($rowData->id);
//
//            $saveTranslation = DeveloperTranslation::where('developer_id',$rowData->id)->where('locale','ar')->firstOrNew();
//
//            if($saveTranslation->g_title == null){
//                $saveTranslation->g_title = $rowData->translate('ar')->name;
//            }
//
//            $saveTranslation->save();
//
//            $saveTranslation = DeveloperTranslation::where('developer_id',$rowData->id)->where('locale','en')->firstOrNew();
//            if($saveTranslation->g_title == null){
//                $saveTranslation->g_title = $rowData->translate('en')->name;
//            }
//
//            $saveTranslation->save();
//
//        }



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
