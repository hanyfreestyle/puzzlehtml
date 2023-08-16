<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\UnitRequest;
use App\Models\admin\config\Amenity;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use App\Models\admin\Location;
use File;
use Validator ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UnitController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'unit')
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
        $sendArr = ['TitlePage' => __('admin/menu.unit'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $pageData['Trashed'] = Listing::onlyTrashed()
            ->forSale()
            ->with('translations')
            ->count();

        $Units = Listing::query()->forSale()
            ->with('translations')
            ->withCount('get_more_photo')
            ->paginate(15);

        return view('admin.listing.unit_index',compact('pageData','Units'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        $Units = Listing::onlyTrashed()
            ->forSale()
            ->paginate(15);
        return view('admin.listing.unit_index',compact('pageData','Units'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.unit') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $Unit = Listing::findOrNew(0);

        return view('admin.listing.unit_form',compact('pageData','Unit'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {

        $sendArr = ['TitlePage' => __('admin/menu.unit') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Unit = Listing::forSale()
        ->where('id','=',$id)
        ->firstOrFail();

        return view('admin.listing.unit_form',compact('pageData','Unit'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UnitRequest $request, $id=0)
    {

        $saveData =  Listing::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->listing_type = "ForSale";
        $saveData->location_id = $request->input('location_id');
        $saveData->developer_id  = $request->input('developer_id');
        $saveData->property_type  = $request->input('property_type');
        $saveData->view  = $request->input('view');
        $saveData->amenity  = $request->input('amenity');


        $saveData->delivery_date  = $request->input('delivery_date');
        $saveData->price  = $request->input('price');
        $saveData->area  = $request->input('area');
        $saveData->baths  = $request->input('baths');
        $saveData->rooms  = $request->input('rooms');
        $saveData->unit_status  = $request->input('unit_status');

        $saveData->latitude   = $request->input('latitude');
        $saveData->longitude   = $request->input('longitude');
        $saveData->youtube_url   = $request->input('youtube_url');
        $saveData->setPublished((bool) request('is_published', false));

        $saveData->save();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('unit/'.$saveData->id);
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
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');
            $saveTranslation->save();
        }

        if($id == '0'){
            return redirect(route('unit.index'))->with('Add.Done',"");
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
        return redirect(route('unit.index'))->with('confirmDelete',"");
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
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function ListMorePhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.unit') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $UnitPhotos = ListingPhoto::where('listing_id','=',$id)->orderBy('position')->get();
        $Unit = Listing::findOrFail($id) ;

        return view('admin.listing.unit_photos',compact('UnitPhotos','pageData','Unit'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function ListOldPhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.unit') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";


        $Unit = Listing::findOrFail($id) ;

        $folderPath = public_path("ckfinder/userfiles_old/".$Unit->slider_images_dir);
        if(File::isDirectory($folderPath)){
            $UnitPhotos = File::files($folderPath);
        }else{
            $UnitPhotos = [];
        }
       return view('admin.listing.unit_old_photos',compact('UnitPhotos','pageData','Unit'));
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
        $saveImgData->setUploadDirIs('unit/'.$request->listing_id);
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
        $sendArr = ['TitlePage' => __('admin/menu.unit'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $Units = Listing::forSale()
            ->with('translations')
            ->where('photo',null)
            ->withCount('get_more_photo')
            ->paginate(15);
        return view('admin.listing.unit_index',compact('pageData','Units'));
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
        $sendArr = ['TitlePage' => __('admin/menu.unit'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $pageData['Trashed'] = Listing::onlyTrashed()
            ->forSale()
            ->with('translations')
            ->count();

        $Units = Listing::forSale()
            ->with('translations')
            ->whereHas('teans_ar', function ($query) {
                $query->where('des', '=', null);
            })
            ->withCount('get_more_photo')
            ->paginate(15);
        return view('admin.listing.unit_index',compact('pageData','Units'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noEn
    public function noEn()
    {
        $sendArr = ['TitlePage' => __('admin/menu.unit'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $Units = Listing::query()->forSale()
            ->with('translations')
            ->whereHas('teans_en', function ($query) {
                $query->where('des', '=', null);
            })
            ->withCount('get_more_photo')
            ->paginate(15);
        return view('admin.listing.unit_index',compact('pageData','Units'));
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     unActive
    public function unActive()
    {
        $sendArr = ['TitlePage' => __('admin/menu.unit'),'restore'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $Units = Listing::query()->forSale()
            ->with('translations')
            ->where('is_published',false)
            ->withCount('get_more_photo')
            ->paginate(15);
        return view('admin.listing.unit_index',compact('pageData','Units'));
    }









}
