<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\UploadFilter;
use App\Http\Requests\admin\config\UploadFilterRequest;
use App\Models\admin\config\UploadFilterSize;
use Cache;
use Illuminate\Support\Facades\View;


class UploadFilterController extends AdminMainController
{

    public $controllerName ;

    function __construct($controllerName = 'upFilter')
    {
        parent::__construct();
        $this->controllerName = $controllerName;
        $this->middleware('permission:'.$controllerName.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$controllerName.'_add', ['only' => ['create']]);
        $this->middleware('permission:'.$controllerName.'_edit', ['only' => ['edit']]);
        $this->middleware('permission:'.$controllerName.'_delete', ['only' => ['destroy']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $sendArr = ['TitlePage' => __('admin/menu.uploadFilter') ,'selMenu'=> 'config.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";

        $rowData = UploadFilter::orderBy('id')->paginate(10);

        return view('admin.config.uploadFilter_index',compact('pageData','rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $sendArr = ['TitlePage' => __('admin/menu.uploadFilter') ,'selMenu'=> 'config.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Add";

        $rowData = UploadFilter::findOrNew(0);
        $rowData['canvas_back'] = '#FFFFFF';
        $rowData['quality_val'] = '85';
        $rowData['convert_state'] = '1';
        $rowData['type'] = '0';
        $rowData['blur_size'] = '0';
        $rowData['pixelate_size'] = '5';
        $rowData['text_state'] = '0';
        $rowData['watermark_state'] = '0';
        $rowDataSize = [];

        return view('admin.config.uploadFiter_form',compact('pageData','rowData','rowDataSize'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id)
    {
        $sendArr = ['TitlePage' => __('admin/menu.uploadFilter') ,'selMenu'=> 'config.' ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "Edit";


        //$rowData = UploadFilter::with('FiltersSize')->findOrFail($id);
        $rowData = UploadFilter::findOrFail($id);
        $rowDataSize = UploadFilterSize::where('filter_id',$id)->get();
        return view('admin.config.uploadFiter_form',compact('pageData','rowData','rowDataSize'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = UploadFilter::where('id',$id);
        $deleteRow->delete();
        Cache::forget('upload_filter_list_cash');
        return redirect(route('config.upFilter.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UploadFilterRequest $request,$id)
    {

        $request-> validated();

        $request['convert_state'] = (isset($request->convert_state)) ? 1 : 0 ;
        $request['greyscale'] = (isset($request->greyscale)) ? 1 : 0 ;
        $request['flip_state'] = (isset($request->flip_state)) ? 1 : 0 ;
        $request['flip_v'] = (isset($request->flip_v)) ? 1 : 0 ;
        $request['blur'] = (isset($request->blur)) ? 1 : 0 ;
        $request['pixelate'] = (isset($request->pixelate)) ? 1 : 0 ;

        $saveData = UploadFilter::findOrNew($id);

        $saveData->name = $request->name;
        $saveData->type = $request->type;
        $saveData->new_w = $request->new_w;
        $saveData->new_h = $request->new_h;
        $saveData->canvas_back = $request->canvas_back;
        $saveData->convert_state = $request->convert_state;
        $saveData->quality_val = $request->quality_val;

        $saveData->greyscale = $request->greyscale;
        $saveData->flip_state = $request->flip_state;
        $saveData->flip_v = $request->flip_v;
        $saveData->blur = $request->blur;
        $saveData->blur_size = $request->blur_size;
        $saveData->pixelate = $request->pixelate;
        $saveData->pixelate_size = $request->pixelate_size;

        $saveData->text_state = $request->text_state;
        $saveData->text_print = $request->text_print;
        $saveData->font_size = $request->font_size;
        $saveData->font_path = $request->font_path;
        $saveData->font_color = $request->font_color;
        $saveData->font_opacity = $request->font_opacity;
        $saveData->text_position = $request->text_position;

        $saveData->watermark_state = $request->watermark_state;
        $saveData->watermark_img = $request->watermark_img;
        $saveData->watermark_position = $request->watermark_position;

        $saveData->save();
        Cache::forget('upload_filter_list_cash');

        if($id == '0'){
            return  back()->with('Add.Done','');
        }else{
            return  back()->with('Edit.Done','');
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
#




}
