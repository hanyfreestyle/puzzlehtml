<?php

namespace App\Helpers;

use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\UploadFilter;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AdminImageUpload  {



    public $size = 20;
    protected $heghit,$width;


    public function getSize($width,$heghit){
        $this->heghit = $heghit;
        $this->width = $width;
    }







     function UploadOne($request,$sendArr=array()){
        $saveData = [];
        $saveDirIs = AdminHelper::arrIsset($sendArr,'saveDirIs','uploads/album/');
        $fileName = AdminHelper::arrIsset($sendArr,'fileName','image');
        $newName = AdminHelper::arrIsset($sendArr,'newName','');


        $saveDirIs = AdminHelper::createDirecrotory($saveDirIs);

        $filterData = UploadFilter::find($request->filter_id );

        $ConvertImage = $filterData->convert_state ;
        $ConvertQuality = $filterData->quality_val ;

        if (request()->hasFile($fileName)) {

            $file = $request->file($fileName);

            $saveImage =  Image::make($file);
            $soursFileExtension = $file->extension();

            if($ConvertImage == '1'){
                $soursFileExtension = "webp";
            }

            if($newName == ''){
                $newName = time()."_".Str::random(15)."_".'.'.$soursFileExtension;
            }else{
                $newName = AdminHelper::Url_Slug($newName).'.'.$soursFileExtension;
            }

            $newName =  AdminHelper::file_newname($saveDirIs,$newName);

            $saveImage->filter(new ImageFilters($request->filter_id));

            if($ConvertImage == '1'){
                $saveImage->save(public_path($saveDirIs.$newName), $ConvertQuality, 'webp');
            }else{
                $saveImage->save(public_path($saveDirIs.$newName), $ConvertQuality, $soursFileExtension);
            }

            $dirPath = $saveDirIs;
            $saveData = [
                "file_original_name"=>$saveImage->filename,
                "file_name"=>$dirPath.$saveImage->basename,
                "extension"=>$saveImage->extension,
                "type"=>"image",
                "file_size"=> $saveImage->filesize(),
                "user_id"=>"9",
            ];
        }
        return $saveData;
    }
}
