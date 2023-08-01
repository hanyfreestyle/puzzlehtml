<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\Location;
use DirectoryIterator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashbord');
    }

    public function TestLang(){
        $dir = resource_path('lang\ar\admin\config');
        $dirs = File::directories($dir);
        $files = File::files($dir);

        foreach ($files as $file){

            echo  $file."<br/>";
        }
        //dd($dirs);





 /*
        $langFile = Lang::get('admin/config/');



        foreach ($langFile as  $key=>$langTxt)
        {
            if (is_array($langTxt))
            {
                foreach ($langTxt as $key_sub => $langTxtsub)
                {
                    echo "------" . $langTxtsub . "<br>";
                }

            } else
            {
                echo $langTxt . "<br>";
            }
        }
*/

    }


    public function location()
    {

        $Projects = Listing::where('parent_id',null)->where('property_type',null)->count();
        echobr($Projects);

        $UnitProject = Listing::where('parent_id','!=',null)->where('property_type',"!=",null)->count();
        echobr($UnitProject);

        $UnitProjectErr = Listing::where('parent_id','!=',null)->where('property_type',null)->count();
        echobr($UnitProjectErr);


        $ForSale = Listing::where('parent_id',null)->where('property_type',"!=",null)->count();
        echobr($ForSale);



        echobr('hr');




        /*
         public function scopeOnlyProject(Builder $query): Builder
    {
        return $query-;
    }

    public function scopeUnitProject(Builder $query): Builder
    {
        return $query->where('parent_id',"!=",null)->where('property_type',"!=",null);
    }

    public function scopeForSaleUnit(Builder $query): Builder
    {
        return $query->where('parent_id',null)->where('property_type',"!=",null);
    }


         */

//    $Projects = Listing::OnlyProject()->get();
//
//        foreach ($Projects as $project)
//        {
//
//            $deleteSubListings = Listing::withTrashed()->where('parent_id','=',$project->id)->get();
//            foreach ($deleteSubListings as $subListing){
//                $subListing->forceDelete();
//            }
//            $project->forceDelete();
//
//
//        }





      $xx = Listing::OnlyProject()->count();
      echobr($xx);

      $xx = Listing::UnitProject()->count();
      echobr($xx);

      $xx = Listing::ForSaleUnit()->count();
      echobr($xx);



//
//        $locations = Location::query()
//            ->where('id','!=', 0)
//            ->with('getProjectToLocation')
//             ->with('getProjectUnitsToLocation')
//             ->with('getUnitsForSaleToLocation')
//            ->get();
//
//
//
//
//         $Project = 0 ;
//         $Unit = 0 ;
//         $forSale = 0 ;
//
//
//
//        foreach ($locations as $location)
//        {
//            echobr($location->name);
//            echobr("Project: ". count($location->getProjectToLocation));
//            echobr("For Sale : ". count($location->getUnitsForSaleToLocation));#getProjectToLocation
//            echobr("Project Unit : ". count($location->getProjectUnitsToLocation));#getProjectToLocation
//            echobr('hr');
//
//            $Project = $Project +count($location->getProjectToLocation);
//            $forSale = $forSale +count($location->getUnitsForSaleToLocation);
//            $Unit = $Unit +count($location->getProjectUnitsToLocation);
//        }
//
//       echobr($Project);
//       echobr($forSale);
//       echobr($Unit);
//       echobr($Project+$Unit+$forSale);



    }

}
