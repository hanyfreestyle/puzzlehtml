<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\MetaTag;
use App\Http\Requests\admin\StoreMetaTagRequest;
use App\Http\Requests\admin\UpdateMetaTagRequest;
use App\Models\admin\MetaTagTranslation;
use App\Models\User;


class MetaTagController extends AdminMainController
{
    public $controllerName = 'meta';

    public function index()
    {
        //User::orderBy('id','desc')->paginate('1')->get();
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $rowData = MetaTag::orderBy('id','desc')->paginate(1);
        $pageData['ViewType'] = "List";
        return view('admin.Meta.index',compact('pageData','rowData'));
    }

    public function create()
    {
        $oldData = new MetaTag();
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Add";
        return view('admin.Meta.form',compact('oldData','pageData'));
    }

    public function store(StoreMetaTagRequest $request)
    {
        $request-> validated();
        MetaTag::create($request->all());
        return redirect(route('Meta.index'));
    }

    public function show(MetaTag $metaTag)
    {
        //
    }

    public function edit($id)
    {

        $oldData = MetaTag::findOrFail($id);
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Edit";
        return view('admin.Meta.form',compact('oldData','pageData'));

    }

    public function update(UpdateMetaTagRequest $request, MetaTag $metaTag)
    {
        $request-> validated();

        $saveData =  MetaTag::findOrFail($request->input('id')) ;
        $saveData->cat_id = $request->input('cat_id');
        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = MetaTagTranslation::where('meta_tag_id',$saveData->id)->where('locale',$key)->first();
            $saveTranslation->g_title = $request->input($key.'.g_title');
            $saveTranslation->g_des = $request->input($key.'.g_des');
            $saveTranslation->body_h1 = $request->input($key.'.body_h1');
            $saveTranslation->breadcrumb = $request->input($key.'.breadcrumb');

            $saveTranslation->save();
        }
       return redirect(route('Meta.index'));
    }

    public function delete($id)
    {
        MetaTag::findOrFail($id)->delete();
        return redirect(route('Meta.index'));
    }
}
