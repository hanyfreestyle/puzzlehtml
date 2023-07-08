<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\Amenity;
use App\Models\admin\config\LangFile;
use App\Http\Requests\StoreLangFileRequest;
use App\Http\Requests\UpdateLangFileRequest;

class LangFileController extends AdminMainController
{
    public $controllerName = 'langadmin';

    public function index()
    {
        $pageData = AdminHelper::returnPageDate($this->controllerName);

        $rowData = LangFile::orderBy('id')->paginate(20);
        $pageData['ViewType'] = "List";
        return view('admin.config.lang_index',compact('pageData','rowData'));
    }

    public function create()
    {
        $rowData = LangFile::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Add";
        return view('admin.config.lang_form',compact('pageData','rowData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUpdate(StoreLangFileRequest $request)
    {


        return 'hi';
    }


    public function edit($id)
    {
        $rowData = LangFile::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Edit";
        return view('admin.config.lang_form',compact('rowData','pageData'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLangFileRequest $request, LangFile $langFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LangFile $langFile)
    {
        //
    }
}
