<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\config\UploadFilterSizeRequest;
use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use App\Models\User;
use Illuminate\Http\Request;

class UploadFilterSizeController extends Controller
{
    public $controllerName = 'upFilter';

    public function create($filterId){
        $FilterData = UploadFilter::findOrFail($filterId);
        $rowData = UploadFilterSize::findOrNew(0);
        $rowData['filter_id'] = $filterId;
        $rowData['canvas_back'] = $FilterData->canvas_back;
        $rowData['type'] = $FilterData->type;

        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Add";
        return view('admin.config.uploadFiterSize_form',compact('pageData','rowData'));
    }

    public function edit($id){
        $rowData = UploadFilterSize::findOrFail($id);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Edit";
        return view('admin.config.uploadFiterSize_form',compact('pageData','rowData'));
    }


    public function storeUpdate(UploadFilterSizeRequest $request,$id)
    {

        $request-> validated();

        $saveData = UploadFilterSize::findOrNew($id);

        $saveData->filter_id = $request->filter_id;
        $saveData->type = $request->type;
        $saveData->new_w = $request->new_w;
        $saveData->new_h = $request->new_h;
        $saveData->canvas_back = $request->canvas_back;
        $saveData->save();

        if($id == '0'){
            return  redirect(route('config.upFilter.edit',$request->filter_id))->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  redirect(route('config.upFilter.edit',$request->filter_id))->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }
    }






    public function destroy($id){
        $deleteRow = UploadFilterSize::findOrFail($id);
        $filterId = $deleteRow->filter_id ;
        $deleteRow->delete();
        return redirect(route('config.upFilter.edit',$filterId))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }
}
