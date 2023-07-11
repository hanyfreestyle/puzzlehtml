<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\UploadFilterSizeRequest;
use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use Illuminate\Support\Facades\View;


class UploadFilterSizeController extends AdminMainController
{
    public $controllerName = 'upFilter';

public function __construct()
{
    $FilterTypeArr = [
        "1"=> ['id'=>'1','name'=>__('admin/config/upFilter.filter_action_1')],
        "2"=> ['id'=>'2','name'=>__('admin/config/upFilter.filter_action_2')],
        "3"=> ['id'=>'3','name'=>__('admin/config/upFilter.filter_action_3')],
        "4"=> ['id'=>'4','name'=>__('admin/config/upFilter.filter_action_4')],
        "5"=> ['id'=>'5','name'=>__('admin/config/upFilter.filter_action_5')],
    ];

    View::share('filterTypeArr', $FilterTypeArr);
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create($filterId){

        $sendArr = ['TitlePage' => __('admin/menu.uploadFilter') ,'selMenu'=> 'config.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";


        $FilterData = UploadFilter::findOrFail($filterId);
        $rowData = UploadFilterSize::findOrNew(0);
        $rowData['filter_id'] = $filterId;
        $rowData['canvas_back'] = $FilterData->canvas_back;
        $rowData['type'] = $FilterData->type;
        $rowData['get_more_option'] = '0';
        $rowData['get_add_text'] = '0';
        $rowData['get_watermark'] = '0';

        return view('admin.config.uploadFiterSize_form',compact('pageData','rowData'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){

        $sendArr = ['TitlePage' => __('admin/menu.uploadFilter') ,'selMenu'=> 'config.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";
        $rowData = UploadFilterSize::findOrFail($id);
        return view('admin.config.uploadFiterSize_form',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UploadFilterSizeRequest $request,$id)
    {

        $request-> validated();

        $saveData = UploadFilterSize::findOrNew($id);

        $saveData->filter_id = $request->filter_id;
        $saveData->type = $request->type;
        $saveData->new_w = $request->new_w;
        $saveData->new_h = $request->new_h;
        $saveData->canvas_back = $request->canvas_back;

        $saveData->get_more_option = $request->get_more_option;
        $saveData->get_add_text = $request->get_add_text;
        $saveData->get_watermark = $request->get_watermark;

        $saveData->save();

        if($id == '0'){
            return  redirect(route('config.upFilter.edit',$request->filter_id))->with('Add.Done','');
        }else{
            return  redirect(route('config.upFilter.edit',$request->filter_id))->with('Edit.Done','');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id){
        $deleteRow = UploadFilterSize::findOrFail($id);
        $filterId = $deleteRow->filter_id ;
        $deleteRow->delete();
        return redirect(route('config.upFilter.edit',$filterId))->with('confirmDelete','');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


















}
