<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\DefPhotoRequest;
use App\Models\admin\config\DefPhoto;
use App\Models\admin\config\UploadFilter;
use Illuminate\Http\Request;




class DefPhotoController extends AdminMainController
{
    public $controllerName = 'defPhoto';

#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $defPhoto = glob("Def/*");
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('postion')->paginate(16);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_index',compact('pageData','rowData','defPhoto'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    /*
     * @ to create data
     * @var hany must be array
     */
    public function create(){
        $rowData = DefPhoto::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');


        $pageData['ViewType'] = "Add";
        return view('admin.config.defphoto_form',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $rowData = DefPhoto::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $filterTypes = UploadFilter::all();
        $pageData['ViewType'] = "Edit";
        return view('admin.config.defphoto_form',compact('rowData','pageData','filterTypes'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id){
        $deleteRow = DefPhoto::findOrFail($id);
        $deleteRow = AdminHelper::onlyDeletePhotos($deleteRow,3);
        $deleteRow->delete();

        return redirect(route('config.defPhoto.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(DefPhotoRequest $request,$id='0'){
        $request-> validated();

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('def-photo');
        $saveImgData->setnewFileName($request->cat_id);
        $saveImgData->UploadOne($request);

        $saveData =  DefPhoto::findOrNew($id) ;
        $saveData->cat_id = $request->input('cat_id');

        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);

        $saveData->save();


        if($id == '0'){
            return redirect(route('config.defPhoto.index'))->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortDefPhotoSave(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  DefPhoto::findOrFail($id) ;
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        return response()->json(['success'=>$positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortDefPhotoList(){
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('postion')->paginate(50);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_indexSort',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     defIconShow
    public function defIconShow(){
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin.deficon.main.title'),
        ];
        return view('admin.config.defIcon_show')
            ->with(compact('pageData'));

    }

}
