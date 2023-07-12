<?php
namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\AmenityRequest;
use App\Models\admin\config\Amenity;

use App\Models\admin\config\AmenityTranslation;



class TempController extends AdminMainController
{
    public $controllerName = 'controllerName';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page') ,'selMenu'=> ''];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";


        //$rowData = User::orderBy('id')->paginate(10);
        $rowData = array();
        return view('admin',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page'),'selMenu'=> ''];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        //$rowData = User::findOrNew(0);
        $rowData = array();
        return view('admin.amenity.form',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/page.new_page') ,'selMenu'=> '' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";

        //$rowData = User::findOrFail($id);
        $rowData = array();
        return view('admin.amenity.form',compact('rowData','pageData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(AmenityRequest $request, $id=0)
    {
        $request-> validated();

        $saveData =  Amenity::findOrNew($id);
        $saveData->icon = $request->icon;

        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = AmenityTranslation::where('amenity_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->amenity_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->save();
        }

        if($id == '0'){
            return  back()->with('Add.Done',"");
        }else{
            return  back()->with('Edit.Done',"");
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = Amenity::findOrFail($id);
        $deleteRow = AdminHelper::onlyDeletePhotos($deleteRow,2);
        $deleteRow->delete();
        return redirect(route('amenity.index'))->with('confirmDelete',"");
    }






}
