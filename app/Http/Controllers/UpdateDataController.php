<?php

namespace App\Http\Controllers;

use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateDataController extends Controller
{

    public function index()
    {

//        $Developers =  Developer::onlyTrashed()->get();
//        foreach ($Developers as $developer)
//        {
//            $developer->forceDelete();
//        }


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



        $Developers =  Developer::query()
            ->where('id',13)
            ->limit(1)
            ->get();
        ;
        foreach ($Developers as $Developer)
        {
            echobr($Developer->id);
            $projects_count = Listing::Project()->where('developer_id',$Developer->id)->count();
            $units_count = Listing::Unit()->where('developer_id',$Developer->id)->count();
            echobr($projects_count);
            echobr($units_count);

            $Developer->projects_count = $projects_count ;
            $Developer->units_count = $units_count ;
            $Developer->save() ;


        }


    }



//$xx =   Str::limit(strip_tags($rowData->translate('ar')->des),150,"...");
//
//echobr($xx);
}
