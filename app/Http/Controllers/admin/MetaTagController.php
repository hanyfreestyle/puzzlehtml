<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\MetaTag;
use App\Http\Requests\admin\StoreMetaTagRequest;
use App\Http\Requests\admin\MetaTagRequest;
use App\Models\admin\MetaTagTranslation;

class MetaTagController extends AdminMainController
{
    public $controllerName = 'meta';

    public function index()
    {
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = MetaTag::orderBy('id','desc')->paginate(10);
        $pageData['ViewType'] = "List";
        return view('admin.config.meta_index',compact('pageData','rowData'));
    }

    public function create()
    {
        $oldData = new MetaTag();
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Add";
        return view('admin.config.meta_form',compact('oldData','pageData'));
    }

    public function edit($id)
    {

        $oldData = MetaTag::findOrFail($id);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Edit";
        return view('admin.config.meta_form',compact('oldData','pageData'));

    }

    public function storeUpdate(MetaTagRequest $request, $id='0')
    {
        $request-> validated();

        $saveData =  MetaTag::findOrNew($id) ;
        $saveData->cat_id = $request->input('cat_id');
        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = MetaTagTranslation::where('meta_tag_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->meta_tag_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');
            $saveTranslation->save();
        }

        if($id == '0'){
            return  back()->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }

    }

    public function delete($id)
    {
        MetaTag::findOrFail($id)->delete();

        return redirect(route('config.meta.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }

}
