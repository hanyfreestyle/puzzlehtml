<?php

namespace App\Helpers;

use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use Intervention\Image\Facades\Image;

class PuzzleUploadProcess extends PuzzleImageUpload
{




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function UploadOneNofilter($request,$type,$width,$height,$sendArr=array()){

        $saveData = array();
        if (request()->hasFile($this->fileUploadName)) {

            $saveData = self::UploadOnebyOne($request,$type,$width,$height,$sendArr);
            return  $this->sendSaveData = $saveData;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadOnebyOne
    public function UploadOnebyOne($request,$type,$width,$height,$sendArr=array()){
        $convert = AdminHelper::arrIsset($sendArr,"convert",1);
        $quality = AdminHelper::arrIsset($sendArr,"quality",70);
        $canvas = AdminHelper::arrIsset($sendArr,"canvas","#fff");

        $file = $request->file($this->fileUploadName);
        $FileExtension = $file->extension();
        if($convert == 1 ){
            $FileExtension = "webp";
        }

        /// الصورة الاصلية
        $saveImage =  Image::make($file);

        $newName = self::getNewName($FileExtension,$this->newFileName,$this->UploadDirIs);

        if($type == "1"){

        }elseif ($type == "2"){
            $saveImage->widen($width, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($type == "3"){
            $saveImage->heighten($height, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($type == "4"){
            $saveImage->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($type == "5"){
            $saveImage->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $saveImage->resizeCanvas($width, $height, 'center', false, $canvas);
        }

        $saveImage->save(public_path($this->UploadDirIs.$newName), $quality, $FileExtension);

        $saveData = [
            $this->defNameInDB => [
                "file_original_name"=>$saveImage->filename,
                "file_name"=>$this->UploadDirIs.$saveImage->basename,
                "extension"=>$saveImage->extension,
                "type"=>"image",
            ],
        ];
        return $saveData ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function  UploadImageNoFilter($filterData,$filterSizeData,$file)
    {

        $FileExtension = self::getFileExtension($file,$filterData);

        /// الصورة الاصلية
        $saveImage =  Image::make($file);

        $newName = self::getNewName($FileExtension,$this->newFileName,$this->UploadDirIs);

        $saveImage->resize(320, 240);

        //$saveImage->filter(new ImageFilters($filterData));

        $saveImage->save(public_path($this->UploadDirIs.$newName), 70, $FileExtension);


        $saveData = [
            # 'defPhoto' => [
            $this->defNameInDB => [
                "file_original_name"=>$saveImage->filename,
                "file_name"=>$this->UploadDirIs.$saveImage->basename,
                "extension"=>$saveImage->extension,
                "type"=>"image",
            ],
        ];

/*
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
*/
        return $saveData ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function UploadOne($request){

        if (request()->hasFile($this->fileUploadName)) {

            $filter_Id = $request->filter_id ;
            $file = $request->file($this->fileUploadName);

            /// بيانات الفلتر
            $filterData = UploadFilter::findorNew($filter_Id);


            // بيانات الصور الاضافيه
            $filterSizeData = UploadFilterSize::where('filter_id',$filter_Id)->get();

            $saveData = self::UploadImage($filterData,$filterSizeData,$file);

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

            /// بيانات الفلتر
            $filterData = UploadFilter::findorNew($filter_Id);

            $filterSizeData = UploadFilterSize::where('filter_id',$filter_Id)->get();

            $index = 1;
            foreach ($images as $key => $file)
            {
                $saveData = self::UploadImage($filterData,$filterSizeData,$file);
                $saveDataArr += ['fileSave_'.$index =>  $saveData ];
                $index++;
            }

        }
        return  $this->sendSaveData = $saveDataArr;

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UploadImage
    public function  UploadImage($filterData,$filterSizeData,$file)
    {

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
