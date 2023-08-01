<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\Location;
use DB;
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


        $locations = Location::query()
           // ->withCount('getProjectToLocation')
            ->with('getUnitsCount')
            ->get()->KeyBy('id');


        $XX = 0 ;
        foreach ($locations as $location)
        {
                echobr($location->name);
                echobr( count($location->getUnitsCount));
                $XX = $XX + count($location->getUnitsCount) ;

        }


        echobr($XX);

        dd($locations);


//        $locations = Location::query()
//            ->with('getProjectToLocation')
//            ->get()
//        ;
//
//
//        foreach ($locations as $location)
//        {
//                echobr($location->name);
//                echobr( count($location->getProjectToLocation));
//
//        }
//    dump($locations);



//        $user_info = Listing::query()
//            ->where('id' , '!=',0 )
//            ->with('locationName')
//            ->select('location_id', DB::raw('count(*) as total'))
//            ->groupBy('location_id')
//            ->orderBy('total', 'desc')
//            ->pluck('total','location_id');




//        $user_info = Listing::query()
//            ->where('id' , '!=',0 )
//            ->with('locationName')
//            ->limit(10)
//            ->get()
//            ->groupBy('listing_type')
//            ->groupBy('location_id')
//
//        ;


//        dd($user_info);

//        foreach ( $user_info as $item)
//        {
//            echobr($item->listing_type);
//            echobr($item->id);
//
//        }



    }


    public function locationS()
    {







//        $UnitProjectErr = Listing::where('parent_id','!=',null)->where('property_type',null)->get();
//        foreach ($UnitProjectErr as $item)
//        {
//            echobr($item->id);
//            echobr($item->name);
//            echobr($item->parent_id);
//            echobr('hr');
//
//        }
//








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





      $xx = Listing::query()->scopes('Project')->count();
      echobr($xx);

      $xx = Listing::Unit()->count();
      echobr($xx);

      $xx = Listing::Project()->count();


      echobr($xx);






        $locations = Location::query()
            ->where('id','!=', 0)
            ->with('getProjectToLocation')
            ->with('getProjectUnitsToLocation')
            ->with('getUnitsForSaleToLocation')
            ->get();

        //dd(count($locations));




         $Project = 0 ;
         $Unit = 0 ;
         $forSale = 0 ;



        foreach ($locations as $location)
        {
            echobr($location->name);
            echobr("Project: ". count($location->getProjectToLocation));
            echobr("For Sale : ". count($location->getUnitsForSaleToLocation));#getProjectToLocation
            echobr("Project Unit : ". count($location->getProjectUnitsToLocation));#getProjectToLocation
            echobr('hr');

            $Project = $Project +count($location->getProjectToLocation);
            $forSale = $forSale +count($location->getUnitsForSaleToLocation);
            $Unit = $Unit +count($location->getProjectUnitsToLocation);
        }

       echobr($Project);
       echobr($forSale);
       echobr($Unit);
       echobr($Project+$Unit+$forSale);



    }

}
