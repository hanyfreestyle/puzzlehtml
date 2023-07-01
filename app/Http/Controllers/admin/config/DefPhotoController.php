<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\DefPhotoRequest;
use App\Models\admin\config\DefPhoto;
use App\Models\admin\config\Setting;


class DefPhotoController extends AdminMainController
{
    public $controllerName = 'defPhoto';


    public function index(){
        $defPhoto = glob("Def/*");
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('id','desc')->paginate(16);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_index',compact('pageData','rowData','defPhoto'));
    }
    public function create(){
        $rowData = DefPhoto::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Add";
        return view('admin.config.defphoto_form',compact('pageData','rowData'));
    }
    public function edit($id){
        $rowData = DefPhoto::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Edit";
        return view('admin.config.defphoto_form',compact('rowData','pageData'));
    }
    public function destroy($id){
        $deleteRow = DefPhoto::where('id',$id);
        $deleteRow->delete();
        return redirect(route('config.defPhoto.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }

    public function defIconShow(){


        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin.menu.setting_web'),
        ];
        return view('admin.config.defIcon_show')
            ->with(compact('pageData'));

    }
    public function storeUpdate(DefPhotoRequest $request,$id='0'){
        $request-> validated();

        $saveData =  DefPhoto::findOrNew($id) ;
        $saveData->cat_id = $request->input('cat_id');
        $saveData->photo = $request->input('photo');
        $saveData->save();

        if($id == '0'){
            return redirect(route('config.defPhoto.index'))->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }

    }
}
