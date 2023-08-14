<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\DeveloperRequest;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperPhoto;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Location;
use Cache;
use DB;
use File;
use Illuminate\Http\Request;

class DeveloperController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'developer')
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
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();
        #$Developers = self::getSelectQuery( Developer::where('id',"!=","0")->withCount('getMorePhoto')->with
        #('translation'));
        $Developers = Developer::query()
            ->with('translation')
            ->withCount('getMorePhoto')
            ->orderBy('id',"desc")
            ->paginate(10)
        ;
        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "deleteList";
        $Developers = self::getSelectQuery(Developer::onlyTrashed());

        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $Developer = Developer::findOrNew(0);
        return view('admin.developer.form',compact('pageData','Developer'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $Developer = Developer::findOrFail($id);
        return view('admin.developer.form',compact('Developer','pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(DeveloperRequest $request, $id=0)
    {

        $saveData =  Developer::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->setActive((bool) request('is_active', false));
        $saveData->save();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('developer/'.$saveData->id);
        $saveImgData->setnewFileName($request->input('slug'));
        $saveImgData->UploadOne($request);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
        $saveData->save();


        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = DeveloperTranslation::where('developer_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->developer_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->des = $request->input($key.'.des');
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');
            $saveTranslation->save();
        }



        if($saveData->slug_count > 1){
            $updateSlugCount = Developer::withTrashed()
                ->where('slug_count' ,'>',"1")
                ->get();
            ;
            if( count($updateSlugCount) > 0 ){
                foreach ($updateSlugCount as $listing){
                    $newCount = Developer::withTrashed()->where('slug', $listing->slug )->count();
                    $listing->slug_count = $newCount;
                    $listing->save();
                }
            }
        }




        Cache::forget('developers_list_cash');

        if($id == '0'){
            return redirect(route('developer.index'))->with('Add.Done',"");
        }else{
            return back();
            ////return redirect(route('category.index'))->with('Edit.Done',"");
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Developer::findOrFail($id);
        $deleteRow->delete();
        Cache::forget('developers_list_cash');
        return redirect(route('developer.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id)
    {
        Developer::onlyTrashed()->where('id',$id)->restore();
        Cache::forget('developers_list_cash');
        return back()->with('restore',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id)
    {

        $delMorePhoto = DeveloperPhoto::where('developer_id',"=",$id)->get();
        if(count($delMorePhoto) > 0){
            foreach ($delMorePhoto as $del_photo ){
                $del_photo = AdminHelper::DeleteAllPhotos($del_photo);
            }
        }

        $deleteRow =  Developer::onlyTrashed()->where('id',$id)->first();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        Cache::forget('developers_list_cash');
        return back()->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  updateStatus
    public function updateStatus(Request $request ){
        $thisId  = $request->send_id;
        $updateData = Developer::findOrFail($thisId);
        if($updateData->is_active == '1'){
            $updateData->is_active = '0';
        }else{
            $updateData->is_active = '1';
        }
        $updateData->save();
        return response()->json(['success'=>$thisId]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     EmptyPhoto
    public function emptyPhoto($id){
        $rowData = Developer::findOrFail($id);
        $rowData = AdminHelper::DeleteAllPhotos($rowData,true);
        $rowData->save();
        return back();
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function ListMorePhoto($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer') ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        $DeveloperPhotos = DeveloperPhoto::where('developer_id','=',$id)->orderBy('position')->with('developerName')->get();
        $Developer = Developer::findOrFail($id) ;

        return view('admin.developer.photos',compact('DeveloperPhotos','pageData','Developer'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortPhotoSave(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  DeveloperPhoto::findOrFail($id) ;
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
        $saveImgData->setUploadDirIs('developer/'.$request->developer_id);
        $saveImgData->setnewFileName($request->input('name'));
        $saveImgData->UploadMultiple($request);

        foreach ($saveImgData->sendSaveData as $newPhoto){
            $saveData =  DeveloperPhoto::findOrNew('0');
            $saveData->developer_id   =  $request->developer_id;
            $saveData->photo = $newPhoto['photo']['file_name'];
            $saveData->photo_thum_1 = $newPhoto['photo_thum_1']['file_name'];
            $saveData->save();
        }

        return back()->with('Add.Done',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     More_PhotosDestroy
    public function More_PhotosDestroy($id){
        $deleteRow = DeveloperPhoto::findOrFail($id);
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->delete();
        return back()->with('confirmDelete',"");
    }








#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function testXXX()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $allData = Location::withTrashed()->get();

        foreach ($allData as $data){
            if($data->photo != null){

                $oldfile = public_path($data->photo);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('locations/', 'newdevelopers/', $data->photo));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }


                $oldfile = public_path($data->photo_thum_1);
                if(File::exists($oldfile)){
                    $newFile = public_path(str_replace('locations/', 'newdevelopers/', $data->photo_thum_1));
                    echo $oldfile;
                    echo "<br>";
                    echo $newFile;
                    echo "<br>";
                    echo '<hr>';
                    File::move($oldfile, $newFile);
                }


            }
        }



        #$Developers = self::getSelectQuery(Developer::query());
        #return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sliderGet
    public function sliderGet()
    {
        // $Developers = self::getSelectQuery(Developer::query());
        $Developers = Developer::where('slider_images_dir','!=',null)
            ->where('slider_get',"=","0")
            ->where('id','!=',"191")
            ->paginate(100);

        $foreign_name = "developer_id";
        $save_table_name = "developer_photos";


        foreach ($Developers as $developer){

            $oldPath = public_path("ckfinder/userfiles_old/".$developer->slider_images_dir);
            $newPath =  public_path("ckfinder/userfiles/".$developer->slider_images_dir) ;

            if(File::exists($oldPath)){
                Update_createDirectory($newPath);

                if(File::exists($newPath)){
                    $files = File::files($oldPath);
                    if( count( $files) >0 ) {
                        foreach ($files as $file){
                            $filename = File::name($file).".".File::extension($file);
                            $OldFileWillCopyFrom = $oldPath."/".$filename;
                            $newFileWillCopy = $newPath."/".$filename;

                            if(!File::exists($newFileWillCopy)){

                                File::copy($OldFileWillCopyFrom,$newFileWillCopy);
                                DB::connection('mysql2')->table($save_table_name)->insert([
                                    $foreign_name => $developer->id,
                                    'photo' => "ckfinder/userfiles/".$developer->slider_images_dir."/".$filename ,
                                    'file_extension' =>  File::extension($file),
                                    'file_size' => File::size($file),

                                ]);

                                $developer->slider_get = 1 ;
                                $developer->save();

                                echobr("save");
                            }
                        }
                    }
                }
            }else{
                $developer->slider_get = 2 ;
                $developer->save();
                echobr("Error");
            }
        }



        dd(count($Developers));
        return view('admin.developer.index',compact('pageData','Developers'));
    }






#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noPhoto
    public function noPhoto()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers = Developer::query()
            ->where('photo',null)
            ->with('translation')
            ->withCount('getMorePhoto')
            ->orderBy('id',"desc")
            ->paginate(10)
        ;


        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     slugErr
    public function slugErr()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers = Developer::query()
            ->where('slug_count','>',1)
            ->with('translation')
            ->withCount('getMorePhoto')
            ->orderBy('id',"desc")
            ->paginate(10)
        ;
        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noEn
    public function noEn()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers= Developer::whereHas('teans_en', function ($query) {
            $query->where('des', '=', null);

        })->paginate(10);

//        echobr( count($Developers));
//        foreach ($Developers as $developer)
//        {
//            echobr($developer->id ." => " .$developer->name);
//        }
//        echobr('----');
        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     noAr
    public function noAr()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers= Developer::whereHas('teans_ar', function ($query) {
            $query->where('des', '=', null);
        })->paginate(10);




        return view('admin.developer.index',compact('pageData','Developers'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     unActive
    public function unActive()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1, 'more_photo'=> 0 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers = Developer::query()
            ->where('is_active',false)
            ->with('translation')
            ->withCount('getMorePhoto')
            ->orderBy('id',"desc")
            ->paginate(10)
        ;


        return view('admin.developer.index',compact('pageData','Developers'));
    }




















}

