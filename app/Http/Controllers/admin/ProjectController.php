<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\ProjectRequest;
use App\Models\admin\Category;
use App\Models\admin\config\Amenity;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use App\Models\admin\Location;
use Illuminate\Http\Request;
use DB;
use File;
use Cache;
use Illuminate\Support\Facades\View;

class ProjectController extends AdminMainController
{

    public $controllerName ;

    function __construct($controllerName = 'project')
    {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->middleware('permission:'.$controllerName.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$controllerName.'_add', ['only' => ['create']]);
        $this->middleware('permission:'.$controllerName.'_edit', ['only' => ['edit']]);
        $this->middleware('permission:'.$controllerName.'_delete', ['only' => ['destroy']]);
        $this->middleware('permission:'.$controllerName.'_restore', ['only' => ['SoftDeletes','Restore','ForceDeletes']]);

        //Cache::flush();
        View::share('Amenities', Amenity::cash_amenities());
        View::share('Developers', Developer::cash_developers());
        View::share('Locations', Location::cash_locations());

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $pageData['Trashed'] = Listing::onlyTrashed()
            ->where('listing_type', 'Project' )
            ->with('translations')
            ->count();

        $Projects = Listing::query()->Project()
            ->with('translations')
            ->withCount('get_more_photo')
            ->withCount('get_units_to_project')
            ->withCount('faq_to_project')
            ->paginate(15);

        return view('admin.listing.project_index',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        $Projects = Listing::onlyTrashed()
            ->Project()
            ->paginate(15);
        return view('admin.listing.project_index',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $Project = Listing::findOrNew(0);

        return view('admin.listing.project_form',compact('pageData','Project'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Project = Listing::query()
            ->where('id','=',$id)
            ->Project()
            ->firstOrFail();
         return view('admin.listing.project_form',compact('pageData','Project'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProjectRequest $request, $id=0)
    {

        $saveData =  Listing::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->listing_type = "Project";
        $saveData->location_id = $request->input('location_id');
        $saveData->developer_id  = $request->input('developer_id');
        $saveData->project_type  = $request->input('project_type');
        $saveData->status  = $request->input('status');

        $saveData->delivery_date  = $request->input('delivery_date');
        $saveData->price  = $request->input('price');
        $saveData->latitude   = $request->input('latitude');
        $saveData->longitude   = $request->input('longitude');
        $saveData->youtube_url   = $request->input('youtube_url');
        $saveData->setPublished((bool) request('is_published', false));
        $saveData->amenity  = $request->input('amenity');
        $saveData->save();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('project/'.$saveData->id);
        $saveImgData->setnewFileName($request->input('slug'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
        $saveData->save();


        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = ListingTranslation::where('listing_id',$saveData->id)
                ->where('locale',$key)
                ->firstOrNew();
            $saveTranslation->listing_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->des = $request->input($key.'.des');
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->save();
        }

        $UpdateUnits = Listing::query()
            ->where('parent_id', '=', $saveData->id)
            ->get();

        if(count($UpdateUnits) > 0){
            foreach ($UpdateUnits as $UpdateUnit){
                $UpdateUnit->location_id = $request->input('location_id');
                $UpdateUnit->developer_id  = $request->input('developer_id');
                $UpdateUnit->delivery_date  = $request->input('delivery_date');
                $UpdateUnit->save();
            }
        }

        if($id == '0'){
            return redirect(route('project.index'))->with('Add.Done',"");
        }else{
            return back();
            ////return redirect(route('post.index'))->with('Edit.Done',"");
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Listing::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('project.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id)
    {
        Listing::onlyTrashed()->where('id',$id)->restore();
        return back()->with('restore',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id)
    {

        $delMorePhoto = ListingPhoto::where('listing_id',"=",$id)->get();

        if(count($delMorePhoto) > 0){
            foreach ($delMorePhoto as $del_photo ){
                $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
            }
        }

        $deleteRow =  Listing::onlyTrashed()->where('id',$id)->first();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);

        $deleteSubListings = Listing::withTrashed()->where('parent_id','=',$id)->get();
        foreach ($deleteSubListings as $subListing){
            $delMorePhoto = ListingPhoto::where('listing_id',"=",$subListing->id)->get();
            if(count($delMorePhoto) > 0){
                foreach ($delMorePhoto as $del_photo ){
                    $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
                }
            }
            $subListing =  AdminHelper::DeleteAllPhotos($subListing);
            $subListing->forceDelete();
        }
        $deleteRow->forceDelete();
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyPhoto($id){
        $rowData = Listing::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData,true);
        $rowData->save();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListMorePhoto
    public function ListMorePhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $ProjectPhotos = ListingPhoto::where('listing_id','=',$id)->orderBy('position')->get();
        $Project = Listing::findOrFail($id) ;

        return view('admin.listing.project_photos',compact('ProjectPhotos','pageData','Project'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ListOldPhoto
    public function ListOldPhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Project = Listing::findOrFail($id) ;

        $folderPath = public_path("ckfinder/userfiles_old/".$Project->slider_images_dir);
        if(File::isDirectory($folderPath)){
            $ProjectPhotos = File::files($folderPath);
        }else{
            $ProjectPhotos = [];
        }
        return view('admin.listing.project_old_photos',compact('ProjectPhotos','pageData','Project'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  ListingPhoto::findOrFail($id) ;
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success'=>$positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     AddMorePhotos
    public function AddMorePhotos(Request $request)
    {

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('project/'.$request->listing_id);
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);

        foreach ($saveImgData->sendSaveData as $newPhoto){
            $saveData =  ListingPhoto::findOrNew('0');
            $saveData->listing_id   =  $request->listing_id;
            $saveData->photo = $newPhoto['photo']['file_name'];
            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            $saveData->save();
        }

        return back()->with('Add.Done',"");

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id){
        $deleteRow = ListingPhoto::findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        return back()->with('confirmDelete',"");
    }





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noPhoto
    public function noPhoto()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $Projects = Listing::Project()
            ->with('translations')
            ->where('photo',null)
            ->paginate(15);
        return view('admin.listing.project_index_err',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     slugErr
    public function slugErr()
    {

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noAr
    public function noAr()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $Projects = Listing::Project()
            ->with('translations')
            ->whereHas('teans_ar', function ($query) {
                $query->where('des', '=', null);
            })
            ->paginate(15);

        return view('admin.listing.project_index_err',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noEn
    public function noEn()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $Projects = Listing::query()->Project()
            ->with('translations')
            ->whereHas('teans_en', function ($query) {
                    $query->where('des', '=', null);
                })
            ->paginate(15);

        return view('admin.listing.project_index_err',compact('pageData','Projects'));
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     unActive
    public function unActive()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $Projects = Listing::query()->where('listing_type','Project')
            ->with('translations')
            ->where('is_published',false)
            ->paginate(15);
         return view('admin.listing.project_index_err',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text






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
#|||||||||||||||||||||||||||||||||||||| #     UpdateImage
    public function UpdateImage(){

        $Listing_List = Listing::where('getslider',"=","0")->limit(1000)->get();
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

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     MoveImage
    public function  MoveImage()
    {
        //$Listing_List = Listing::where('getslider',"=","1")->limit(1000)->get();
        $Listing_List = Listing::where('getslider',"=","1")->where('photo','!=',null)->limit(1000)->get();
        echobr(count($Listing_List));
        if(count($Listing_List) > 0){
            foreach ($Listing_List as $list){
                $err_photo = 0;
                $err_photo_2 = 0;

                $oldfile = public_path($list->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('listings/', 'newlistings/', $list->photo));
                    File::move($oldfile, $newFile);
                }else{
                    $err_photo = 1 ;
                }

                $oldfile = public_path($list->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('listings/', 'newlistings/', $list->photo_thum_1));
                    File::move($oldfile, $newFile);
                }else{
                    $err_photo_2 = 1 ;
                }


                if($err_photo == 1 or $err_photo_2 == 1 ){
                    $list->getslider = 2;
                    $list->save();
                }else{
                    $list->getslider = 0;
                    $list->save();
                }

            }

        }
        $Listing_List = Listing::where('getslider',"=","1")->where('photo','!=',null)->get();
        echobr(count($Listing_List));

        $Listing_List = Listing::where('getslider',"=","0")->get();
        echobr(count($Listing_List));


    }
    public function  indexYYYY(){
//        $Listings = Listing::where('getslider',"=","1")
//            ->where('slider_images_dir','!=',null)
//            ->where('parent_id' , '=', null )
//            ->where('property_type','=',null)
//            ->where('slidercount','=','1')
//            ->count();

        $Listings = Listing::where('slider_active',"=","0")
            ->where('slider_images_dir','!=',null)
            ->limit(500)
            ->get();

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


        $Listings = Listing::where('slider_active',"=","2")
            ->where('slider_images_dir','!=',null)
            ->count();

        echobr($Listings);


    }
    public function  indexXXXXXXXX(){

        /*
        $Listing_List = Listing::where('getslider',"=","0")->where('slider_images_dir','!=',null)
            ->groupBy('slider_images_dir');

        dd($Listing_List);
        echobr(count($Listing_List));


        $user_info = DB::table('listings')
            ->where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->select('slider_images_dir', DB::raw('count(*) as total'))
            ->groupBy('slider_images_dir')
            ->pluck('total','slider_images_dir');

*/

        $Listings = Listing::where('getslider',"=","0")
            ->where('slider_images_dir','!=',null)
            ->where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->limit(100)
            ->get();





        if(count($Listings) > 0){
            foreach ($Listings as $unit){
                $count =  Listing::where('slider_images_dir','=',$unit->slider_images_dir)->count();
                $unit->getslider = 1;
                $unit->slidercount = intval($count);
                $unit->save();
            }
        }


        $Listings = Listing::where('getslider',"=","0")
            ->where('slider_images_dir','!=',null)
            ->where('parent_id' , '=', null )
            ->where('property_type','!=',null)
            ->count();

        dd($Listings);


//        $user_info = DB::table('listings')
//            ->where('parent_id' , '=', null )
//            ->where('property_type','!=',null)
//            ->select('slider_images_dir', DB::raw('count(*) as total'))
//            ->groupBy('slider_images_dir')
//            ->orderBy('total', 'desc')
//            ->pluck('total','slider_images_dir');
//
//
//        dd($user_info);

    }


}
