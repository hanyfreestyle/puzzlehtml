<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Helpers\AdminImageUpload;
use App\Helpers\HanyUpload;
use App\Helpers\ImageFilters;
use App\Http\Controllers\AdminMainController;

use App\Http\Requests\admin\config\DefPhotoRequest;
use App\Models\admin\config\DefPhoto;
use App\Models\admin\config\UploadFilter;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;



class DefPhotoController extends AdminMainController
{
    public $controllerName = 'defPhoto';

#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $defPhoto = glob("Def/*");
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('postion')->paginate(16);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_index',compact('pageData','rowData','defPhoto'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    /*
     * @ to create data
     * @var hany must be array
     */
    public function create(){
        $rowData = DefPhoto::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');

        $filterTypes = UploadFilter::all();
        $pageData['ViewType'] = "Add";
        return view('admin.config.defphoto_form',compact('pageData','rowData','filterTypes'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $rowData = DefPhoto::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $filterTypes = UploadFilter::all();
        $pageData['ViewType'] = "Edit";
        return view('admin.config.defphoto_form',compact('rowData','pageData','filterTypes'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id){
        $deleteRow = DefPhoto::findOrNew($id);
        if(File::exists($deleteRow->photo)){
            File::delete($deleteRow->photo);
        }
        $deleteRow->delete();
        return redirect(route('config.defPhoto.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(DefPhotoRequest $request,$id='0'){

        $request-> validated();



        $sendArr = [
           // "newName"=> 'Hany Darwish',
            //"saveDirIs"=> 'uploads/album/22/',
        ];
        $saveImgData  = AdminImageUpload::UploadOne($request,$sendArr);


        dd($saveImgData);



        $saveData =  DefPhoto::findOrNew($id) ;
        $saveData->cat_id = $request->input('cat_id');
        if(count($saveImgData) != '0'){
            if(File::exists($saveData->photo)){
                File::delete($saveData->photo);
            }
            $saveData->photo = $saveImgData['file_name'];
        }else{

        }


        $saveData->save();

        if($id == '0'){
            return redirect(route('config.defPhoto.index'))->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortDefPhotoSave(Request $request){
        $positions = $request->positions;
        foreach($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData =  DefPhoto::findOrFail($id) ;
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        return response()->json(['success'=>$positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     sortDefPhotoList
    public function sortDefPhotoList(){
        $pageData = AdminHelper::returnPageDate($this->controllerName,'admin.','config.');
        $rowData = DefPhoto::orderBy('postion')->paginate(50);
        $pageData['ViewType'] = "List";
        return view('admin.config.defphoto_indexSort',compact('pageData','rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     defIconShow
    public function defIconShow(){
        $pageData =[
            'ViewType'=>"Page",
            'TitlePage'=> __('admin.deficon.main.title'),
        ];
        return view('admin.config.defIcon_show')
            ->with(compact('pageData'));

    }

    public function storeUpdateSaveMoreThanImage(DefPhotoRequest $request,$id='0'){

        $filterData = UploadFilter::find($request->filter_id );

        $ConvertImage = $filterData->convert_state ;
        $ConvertQuality = $filterData->quality_val ;

        $saveDirIs = 'public/uploads/album/';

        if (request()->hasFile('image')) {
            $images = $request->file('image');

            foreach ($images as $key => $file) {

                $saveImage =  Image::make($file);
                $soursFileExtension = $file->extension();

                if($ConvertImage == '1'){
                    $soursFileExtension = "webp";
                }

                $newName = time()."_".Str::random(15)."_".'.'.$soursFileExtension;
                $newName =  AdminHelper::file_newname($saveDirIs,$newName);
                $saveImage->filter(new ImageFilters($request->filter_id));

                if($ConvertImage == '1'){
                    $saveImage->save(base_path($saveDirIs.$newName), $ConvertQuality, 'webp');
                }else{
                    $saveImage->save(base_path($saveDirIs.$newName), $ConvertQuality, $soursFileExtension);
                }

                $dirPath = 'uploads/album/';
                $saveData = [
                    "file_original_name"=>$saveImage->filename,
                    "file_name"=>$dirPath.$saveImage->basename,
                    "extension"=>$saveImage->extension,
                    "type"=>"image",
                    "file_size"=> $saveImage->filesize(),
                    "user_id"=>"9",
                ];

            }
        }


        dd($saveData);

        /*
        $request-> validated();

        $saveData =  DefPhoto::findOrNew($id) ;
        $saveData->cat_id = $request->input('cat_id');
        $saveData->photo = $request->input('photo');
        $saveData->save();

        if($id == '0'){
            return redirect(route('config.defPhoto.index'))->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return  back()->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }
*/
    }

}
