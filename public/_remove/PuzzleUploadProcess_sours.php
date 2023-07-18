<?php

namespace App\Helpers;

use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use Intervention\Image\Facades\Image;

class PuzzleUploadProcess extends PuzzleImageUpload
{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function UploadOne($request){

        if (request()->hasFile($this->fileUploadName)) {

            $filter_Id = $request->filter_id ;
            $file = $request->file($this->fileUploadName);

            $saveData = self::UploadImage($filter_Id,$file);

            return  $this->sendSaveData = $saveData;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function UploadMultiple($request){
        $saveDataArr = [] ;
        if (request()->hasFile($this->fileUploadName)){
            $images = $request->file('image');

            $filter_Id = $request->filter_id ;
            $index = 1;
            foreach ($images as $key => $file)
            {
                $saveData = self::UploadImage($filter_Id,$file);
                $saveDataArr += ['fileSave_'.$index =>  $saveData ];
                $index++;
            }

        }
        return  $this->sendSaveData = $saveDataArr;

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function  UploadImage($filter_Id,$file)
    {
        /// بيانات الفلتر
        $filterData = UploadFilter::find($filter_Id);

        // بيانات الصور الاضافيه
        $filterSizeData = UploadFilterSize::where('filter_id',$filter_Id)->get();


        $FileExtension = self::getFileExtension($file,$filterData);

        /// الصورة الاصلية
        $saveImage =  Image::make($file);

        $newName = self::getNewName($FileExtension,$this->newFileName,$this->UploadDirIs);


        $saveImage->filter(new ImageFilters($filterData));

        $saveImage->save(public_path($this->UploadDirIs.$newName), $filterData->quality_val, $FileExtension);


        $saveData = [
           # 'defPhoto' => [
           $this->defNameInDB => [
                "file_original_name"=>$saveImage->filename,
                "file_name"=>$this->UploadDirIs.$saveImage->basename,
                "extension"=>$saveImage->extension,
                "type"=>"image",
            ],
        ];


        if(count($filterSizeData) > 0 and $this->setCountOfUpload > 1 ){
            $index = 1;
            foreach ($filterSizeData as $newFilter ){

                if($index < $this->setCountOfUpload ){

                    $newFilter =  self::mergeOldfilter($filterData,$newFilter);

                    $saveImage =  Image::make($file);
                    $newName = self::getNewName($FileExtension,$this->newFileName,$this->UploadDirIs);

                    $saveImage->filter(new ImageFilters($newFilter));

                    $saveImage->save(public_path($this->UploadDirIs.$newName), $filterData->quality_val, $FileExtension);

                    $saveData += [
                        $this->thumNameInDB.$index => [  #  thumphoto_
                            "file_original_name"=>$saveImage->filename,
                            "file_name"=>$this->UploadDirIs.$saveImage->basename,
                            "extension"=>$saveImage->extension,
                            "type"=>"image",
                        ],
                    ];
                }

                $index++;
            }
        }
        return $saveData ;
    }

}
