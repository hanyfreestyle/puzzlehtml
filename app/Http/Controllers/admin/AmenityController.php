<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\Amenity;
use App\Http\Requests\Admin\AmenityRequest;
use App\Models\admin\AmenityTranslation;


class AmenityController extends AdminMainController
{
    public $controllerName = 'amenity';

    public function index()
    {
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $rowData = Amenity::orderBy('id','desc')->paginate(20);
        $pageData['ViewType'] = "List";
        return view('admin.amenity.index',compact('pageData','rowData'));
    }
    public function create()
    {
        $rowData = Amenity::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Add";
        return view('admin.amenity.form',compact('pageData','rowData'));
    }


    public function storeUpdate(AmenityRequest $request, $id=0)
    {
        $request-> validated();

        if($request->input('icon') == 'empty'){
            $request->icon = "";
        }

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
            return  back()->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }
    }


    public function show(Amenity $amenity,$id){}


    public function edit($id)
    {
        $rowData = Amenity::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Edit";
        return view('admin.amenity.form',compact('rowData','pageData'));
    }



    public function destroy($id)
    {

       // dd($id);
        $deleteRow = Amenity::where('id',$id);
        $deleteRow->delete();
        return redirect(route('amenity.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }
}
