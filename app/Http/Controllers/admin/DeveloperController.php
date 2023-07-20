<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\DeveloperRequest;
use App\Models\admin\Developer;
use App\Models\admin\DeveloperTranslation;
use App\Models\admin\Location;
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
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

       // $Developers = self::getSelectQuery(Developer::query());
        $Developers = Developer::where('slider_images_dir','!=',null)->get();

        dd(count($Developers));
        return view('admin.developer.index',compact('pageData','Developers'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.developer'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Developer::onlyTrashed()->count();

        $Developers = self::getSelectQuery(Developer::query());
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

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('developer');
        $saveImgData->setnewFileName($request->input('slug'));
        $saveImgData->UploadOne($request);

        $saveData =  Developer::findOrNew($id);
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->setActive((bool) request('is_active', false));
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
        return redirect(route('category.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function Restore($id)
    {
        Developer::onlyTrashed()->where('id',$id)->restore();
        return back()->with('restore',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id)
    {
        $deleteRow =  Developer::onlyTrashed()->where('id',$id)->first();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
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
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text





}
