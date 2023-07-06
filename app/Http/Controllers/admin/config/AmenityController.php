<?php



namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Helpers\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\Amenity;
use App\Http\Requests\Admin\config\AmenityRequest;
use App\Models\admin\config\AmenityTranslation;
use App\Models\admin\config\DefPhoto;


class AmenityController extends AdminMainController
{
    public $controllerName = 'amenity';

    public function index()
    {
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $rowData = Amenity::orderBy('id')->paginate(20);
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


        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('amenity');
        $saveImgData->setnewFileName($request->input('en.name'));
        $saveImgData->UploadOne($request);




        $saveData =  Amenity::findOrNew($id);
        $saveData->icon = $request->icon;
        $saveData = AdminHelper::saveAndDeletePhoto($saveData,$saveImgData);
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
