<?php

namespace App\Http\Controllers;

use App\Models\admin\Amenitable;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Listing;
use App\Models\admin\ListingTranslation;
use App\Models\admin\Post;
use App\Models\admin\PostLoction;
use App\Models\admin\PostTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB ;
use File ;

class UpdateDataController extends Controller
{

    public function index_posy_slug_count()
    {

//        $Posts = Post::where('slug_count',0)
//            ->limit(200)
//            ->get();
//
//        if(count($Posts) > 0){
//            foreach ($Posts as $post)
//            {
//                $slugCount = Post::query()->where('slug',$post->slug)->count();
//                $post->slug_count = $slugCount ;
//                $post->save();
//            }
//
//        }

      //  slug_count


        $Posts = Post::where('slug_count','>',1)
            ->count();

        echobr(($Posts));


    }


    public function index_xxxxsssss()
    {



//        $Projects = Post::where('lang' , '=', '0' )
//            ->limit(173)
//            ->get();
//
//        foreach ($Projects as $project)
//        {
//
//                echobr($project->id);
//
//
//            $countLang  = PostTranslation::query()->where('post_id',$project->id)->count();
//            $project->lang = $countLang;
//            $project->save();
//
//        }
//
//
//        $Projects = Post::where('lang' , '=', '0' )->count();
//        echobr($Projects);
//
//



        $Projects = Post::where('lang' , '=', '1' )
            ->limit(50)
            ->get();

        foreach ($Projects as $project)
        {


            $Lang_ar  = PostTranslation::query()
                ->where('post_id',$project->id)
                ->where('locale','ar')
                ->count();

            if($Lang_ar == 0){
                $addLang = PostTranslation::query()
                    ->where('post_id',$project->id)
                    ->where('locale','ar')
                    ->firstOrNew();

                $addLang->post_id = $project->id ;
                $addLang->locale = 'ar' ;
                $addLang->save() ;

            }




            $Lang_en  = PostTranslation::query()
                ->where('post_id',$project->id)
                ->where('locale','en')
                ->count();

            if($Lang_en == 0){
                $addLang = PostTranslation::query()
                    ->where('post_id',$project->id)
                    ->where('locale','en')
                    ->firstOrNew();

                $addLang->post_id = $project->id ;
                $addLang->locale = 'en' ;
                $addLang->save() ;

            }


            $project->lang = 2;
            $project->save();





        }

        $Projects = Post::where('lang' , '=', '1' )
            ->count();

        echobr($Projects);



    }



    public function index_amenity()
    {
        $Projects = Listing::where('listing_type' , 'ForSale' )
            ->where('getslider',0)
            ->with('getoldtools')
            ->limit(400)
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

                     //echobr($project->id);

                }

                 $project->getslider = 1 ;
                 $project->save() ;

            }
        }


        $Projects = Listing::where('listing_type' , 'ForSale' )
            ->where('getslider',0)
            ->count();

        echobr($Projects);

    }


    public function UpdateForSale()
    {









        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->where("check_data","=",0)
            ->count();

        echobr($Projects);


    }


    public function index_slider_active()
    {
        $Listings = Listing::where('slider_active',"=","0")
            ->where('slider_images_dir','!=',null)
            ->limit(500)
            ->get();

        echobr(count($Listings));

        if(count($Listings) > 0 ){
            foreach ($Listings as $list){
                $folderPath = public_path("ckfinder/userfiles_old/".$list->slider_images_dir);
                if(File::isDirectory($folderPath)){
                    $files = File::files($folderPath);
                    if( count($files) > 0 ) {
                        $list->slider_active = 1;
                        $list->save();
                    }else{
                        $list->slider_active = 2;
                        $list->save();
                    }
                }else{
                    $list->slider_active = 2;
                    $list->save();
                }
            }
        }



        $Listings = Listing::where('slider_active',"=","0")
            ->where('slider_images_dir','!=',null)
            ->count();

        echobr(($Listings));

    }


    public function index_lang()
    {
        $Projects = Listing::query()
            ->where('lang',0)
            ->limit(500)
            ->get();

            echobr(count($Projects));

        foreach ($Projects as $project)
        {
                $lang = Listing::query()->where('slug',$project->slug)->count();
                $project->lang = $lang;
                $project->save();
        }




        $Project = Listing::query()
            ->where('lang',0)
            ->count();

        echobr($Project);


        $Project = Listing::query()
            ->where('lang','>',1)
            ->count();

        echobr($Project);


    }


    public function index_published()
    {

        $Projects = Listing::withTrashed()
            ->where('listing_type' , '=', 'Project' )
            ->where('is_published' , '=', false)
            ->get();

        echobr("Un published Project  " . count($Projects));
        echobr();
        foreach ($Projects as $project)
        {
            echobr($project->id." => ". $project->name);
            echobr(  'https://realestate.eg/ar/'.$project->slug);
            echobr('hr');
        }

        echobr('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
        echobr();
        $Projects = Listing::withTrashed()
            ->where('listing_type' , '=', 'Unit' )
            ->where('is_published' , '=', false)
            ->get();

        echobr("Un published Unit  " . count($Projects));
        echobr();
        foreach ($Projects as $project)
        {
            echobr($project->id." => ". $project->name);
            echobr(  'https://realestate.eg/ar/'.$project->slug);
            echobr('hr');
        }

        echobr('@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@');
        echobr();

        $Projects = Listing::withTrashed()
            ->where('listing_type' , '=', 'ForSale' )
            ->where('is_published' , '=', false)
            ->get();

        echobr("Un published ForSale  " . count($Projects));
        echobr();
        foreach ($Projects as $project)
        {
            echobr($project->id." => ". $project->name);
            echobr(  'https://realestate.eg/ar/'.$project->slug);
            echobr('hr');
        }

        echobr();
        echobr();
        echobr();
        echobr();
        echobr();


    }

    public function index_xxxx()
    {


//        $Projects = Listing::withTrashed()
//            ->where('listing_type' , '=', 'Project' )
//            ->where('project_type' , '!=', null)
//
//
//            ->get();
//
//
//
//        echobr(count($Projects));
//        foreach ($Projects as $Project){
//
//          // echobr($Project->id ." ".$Project->project_type);
//
////            $Project->listing_type = "ForSale";
////            $Project->save();
//
//
//        }






//        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Project' )
//            ->where('is_published',false)
//            ->get();


        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Project' )
            //->where('developer_id',null)
                ->where('units_count',0)
                ->where('is_published',true)
            ->get();


        foreach ($Projects as $project)
        {
            echobr($project->id." => ". $project->name);
            echobr(  'https://realestate.eg/ar/'.$project->slug);
            echobr('hr');
        }

        echobr(count($Projects));
        echobr('jjjjjjjjjjjjjj');
    }



    public function index_updateUnits()
    {

//        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Project' )
//            ->where('developer_id',null)
//            ->get();
//
//        if(count($Projects) > 0){
//            foreach ($Projects as $project){
//                $project->developer_id = '348';
//                $project->save();
//            }
//        }







        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Project' )
            ->where('getslider',0)
            ->limit(30)
            ->get();

        if(count($Projects) > 0){
            foreach ($Projects as $project){

                $Units = Listing::query()->where('parent_id',$project->id)->get();

                if(count($Units) > 0){
                    foreach ($Units as $unit)
                    {
                        $unit->location_id = $project->location_id;
                        $unit->developer_id = $project->developer_id;
                        $unit->delivery_date  = $project->delivery_date ;
                        $unit->latitude  =null ;
                        $unit->longitude  = null ;
                        $unit->youtube_url  = null ;
                        $unit->save();
                    }
                }

                $project->units_count = count($Units) ;
                $project->getslider = 1 ;
                $project->save() ;

                echobr(count($Units));

            }
        }




        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Project' )
            ->where('getslider',0)
            ->get();
        echobr( count($Projects));

//
//        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'ForSale' )
//            ->get();
//
//        echobr( count($Projects));
//
//
//        $Projects = Listing::withTrashed()->where('listing_type' , '=', 'Unit' )
//            ->where('developer_id',null)
//            ->get();

//        echobr( count($Projects));


    }



    public function update_lang()
    {



//        $Projects = Listing::where('lang' , '=', '0' )
//            ->limit(1000)
//            ->get();
//
//        foreach ($Projects as $project)
//        {
//
//
//            $countLang  = ListingTranslation::query()->where('listing_id',$project->id)->count();
//            $project->lang = $countLang;
//            $project->save();

//        }


//        $Projects = Listing::where('lang' , '=', '0' )->count();
//        echobr($Projects);


        $Projects = Listing::where('lang' , '=', '1' )
            ->limit(50)
            ->get();

        foreach ($Projects as $project)
        {


            $Lang_ar  = ListingTranslation::query()
                ->where('listing_id',$project->id)
                ->where('locale','ar')
                ->count();

            if($Lang_ar == 0){
                $addLang = ListingTranslation::query()
                    ->where('listing_id',$project->id)
                    ->where('locale','ar')
                    ->firstOrNew();

                $addLang->listing_id = $project->id ;
                $addLang->locale = 'ar' ;
                $addLang->save() ;

            }




            $Lang_en  = ListingTranslation::query()
                ->where('listing_id',$project->id)
                ->where('locale','en')
                ->count();

            if($Lang_en == 0){
                $addLang = ListingTranslation::query()
                    ->where('listing_id',$project->id)
                    ->where('locale','en')
                    ->firstOrNew();

                $addLang->listing_id = $project->id ;
                $addLang->locale = 'en' ;
                $addLang->save() ;

            }


          $project->lang = 2;
          $project->save();





        }

        $Projects = Listing::where('lang' , '=', '1' )
            ->count();

        echobr($Projects);



    }




    public function index_delete()
    {
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




    public function update_listing_type()
    {

//        $All = Listing::withTrashed()->count();
//        echobr("All : ".$All);
//
//        $Trashed = Listing::onlyTrashed()->count();
//        echobr("Trashed : ".$Trashed);
//
//        $Active = Listing::get()->count();
//        echobr("Active : ".$Active);
//
//
//        $project = Listing::withTrashed()->where('parent_id' , '=', null )
//            ->where('property_type','=',null)
//            ->count();
//        echobr("Project : ".$project);
//
//
//        $Units = Listing::withTrashed()->where('parent_id' , '=', null )
//            ->where('property_type','!=',null)
//            ->count();
//        echobr("Units : ".$Units);
//
//
        $UnitsToProject = Listing::withTrashed()->where('parent_id' , '!=', null )
            ->count();
        echobr("Units To Project : ".$UnitsToProject);




        $Units = Listing::withTrashed()->where('listing_type' , '=', 'NotList' )
            ->limit(1000)

            ->get();

        echobr("NotList : ". count($Units));

        if(count($Units) >0){
            foreach ($Units as $Unit)
            {
                $Unit->listing_type = "Unit";
                $Unit->save();
            }

        }




        $project = Listing::withTrashed()->where('listing_type' , '=', 'Unit' )
              ->count();
        echobr("Project : ".$project);


    }

    public function listing_getslider()
    {
        $Listing_List = Listing::where('getslider',"=","0")->limit(500)->get();
        if(count($Listing_List) > 0){
            foreach ($Listing_List as $oneList){
                $old_Post = DB::connection('mysql2')->table('images')
                    ->where('imageable_type','=',"App\Listing")
                    ->where('imageable_id',"=",$oneList->id)
                    ->get();

                $Update = Listing::findOrFail($oneList->id);
                if(count($old_Post) == '1'){
                    $Update->photo = $old_Post->first()->image_url;
                    $Update->photo_thum_1 = $old_Post->first()->thumb_url;
                }
                $Update->getslider = 1;
                $Update->save();
            }
        }else{
            echobr('nodata');
        }
        $Listing_List = Listing::where('getslider',"=","0")->count();
        echobr($Listing_List);

        $Listing_List = Listing::where('getslider',"=","1")->count();
        echobr($Listing_List);

    }

    public function index_Developer()
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
