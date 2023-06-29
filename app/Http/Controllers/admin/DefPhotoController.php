<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\DefPhotoRequest;
use App\Models\admin\Amenity;
use App\Models\admin\DefPhoto;


class DefPhotoController extends AdminMainController
{
    public $controllerName = 'defPhoto';

    public function index()
    {
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('id','desc')->paginate(20);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_index',compact('pageData','rowData'));
    }


    public function create()
    {
        $rowData = DefPhoto::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Add";
        return view('admin.config.defphoto_form',compact('pageData','rowData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DefPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DefPhoto $defPhoto)
    {
        //
    }


    public function edit($id)
    {
        $rowData = DefPhoto::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $pageData['ViewType'] = "Edit";
        return view('admin.config.defphoto_form',compact('rowData','pageData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DefPhotoRequest $request, DefPhoto $defPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefPhoto $defPhoto)
    {
        //
    }
}
