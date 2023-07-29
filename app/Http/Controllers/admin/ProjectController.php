<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\ProjectRequest;
use App\Models\admin\Category;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\ListingPhoto;
use App\Models\admin\ListingTranslation;
use Illuminate\Http\Request;

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
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Listing::onlyTrashed()
            ->where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->count();

        $Projects = Listing::where('parent_id' , '=', null )
            ->where('property_type','=',null)
            ->with('unitsToProject')
            ->with('getMorePhoto')
            ->paginate(15);
//        $Projects = self::getSelectQuery( Listing::where('id',"!=","0")->with('unitsToProject')->with('getMorePhoto')
//            ->with('faqToProject'));

        return view('admin.listing.project_index',compact('pageData','Projects'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes()
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        //$Projects = self::getSelectQuery(Listing::onlyTrashed());
        $Projects = Listing::onlyTrashed()
            ->where('parent_id' , '=', null )
            ->where('property_type','=',null)->paginate(15);

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
        $Developers = Developer::all();
        $Categories = Category::all();
        return view('admin.listing.project_form',compact('pageData','Project','Developers','Categories'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.project') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Project = Listing::findOrFail($id);
        $Developers = Developer::all();
        $Categories = Category::all();
        return view('admin.listing.project_form',compact('pageData','Project','Developers','Categories'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ProjectRequest $request, $id=0)
    {



        $saveData =  Listing::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
//        $saveData->category_id = $request->input('category_id');
//        $saveData->developer_id = $request->input('developer_id');
//        $saveData->setPublished((bool) request('is_published', false));
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
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');
            $saveTranslation->save();
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
#|||||||||||||||||||||||||||||||||||||| #     edit
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



    public function indexXXX()
    {

    }


}
