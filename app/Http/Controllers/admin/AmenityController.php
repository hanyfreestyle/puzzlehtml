<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\Amenity;
use App\Http\Requests\Admin\StoreAmenityRequest;
use App\Http\Requests\Admin\UpdateAmenityRequest;
use App\Models\admin\AmenityTranslation;
use Illuminate\Http\Request;

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
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Add";
        return view('admin.amenity.add',compact('pageData'));
    }


    public function store(StoreAmenityRequest $request)
    {
        $request-> validated();
        $saveData = new Amenity();
        $saveData->icon = $request->input('icon');
        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = new AmenityTranslation();
            $saveTranslation->amenity_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->save();
        }
        return redirect(route('amenity.index'));
    }


    public function show(Amenity $amenity,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $oldData = Amenity::findOrFail($id);
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Edit";
        return view('admin.amenity.edit',compact('oldData','pageData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request,$id)
    {

       // dd($request->all());
        $request-> validated();

        $saveData =  Amenity::findOrFail($id) ;
        $saveData->icon = $request->input('icon');
        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = AmenityTranslation::where('amenity_id',$saveData->id)->where('locale',$key)->first();
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->save();
        }

        return redirect(route('amenity.index'));
    }


    public function destroy($id)
    {
        $deleteRow = Amenity::where('id',$id);
        $deleteRow->delete();
        return redirect(route('amenity.index'));
    }
}
