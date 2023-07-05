<?php

namespace App\Helpers;

use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PuzzleImageUpload
{
    public $UploadDirIs ;
    public $newFileName ;
    public $fileUploadName ;
    public $sendSaveData ;

    public function __construct(
        $UploadDirIs = 'images/',
        $newFileName = null,
        $fileUploadName = 'image',
        $sendSaveData = array(),
    )
    {
        $this->UploadDirIs = $UploadDirIs ;
        $this->newFileName = $newFileName ;
        $this->fileUploadName = $fileUploadName ;
        $this->sendSaveData = $sendSaveData ;
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
            'defPhoto' => [
                "file_original_name"=>$saveImage->filename,
                "file_name"=>$this->UploadDirIs.$saveImage->basename,
                "extension"=>$saveImage->extension,
                "type"=>"image",
            ],
        ];


        if(count($filterSizeData) > 0){
            $index = 1;
            foreach ($filterSizeData as $newFilter ){

                $newFilter =  self::mergeOldfilter($filterData,$newFilter);

                $saveImage =  Image::make($file);
                $newName = self::getNewName($FileExtension,$this->newFileName,$this->UploadDirIs);

                $saveImage->filter(new ImageFilters($newFilter));

                $saveImage->save(public_path($this->UploadDirIs.$newName), $filterData->quality_val, $FileExtension);

                $saveData += [
                    'thumPhoto_'.$index => [
                        "file_original_name"=>$saveImage->filename,
                        "file_name"=>$this->UploadDirIs.$saveImage->basename,
                        "extension"=>$saveImage->extension,
                        "type"=>"image",
                    ],
                ];

                $index++;
            }

        }
        return $saveData ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     mergeOldfilter
    static function mergeOldfilter($filterData,$newFilter){

        if(intval($newFilter->get_add_text) == 1 and $filterData->text_state == 1){
            $newFilter['text_state'] = $filterData->text_state;
            $newFilter['text_print'] = $filterData->text_print;
            $newFilter['font_size'] = $filterData->font_size;
            $newFilter['font_path'] = $filterData->font_path;
            $newFilter['font_color'] = $filterData->font_color;
            $newFilter['font_opacity'] = $filterData->font_opacity;
            $newFilter['text_position'] = $filterData->text_position;
        }

        if(intval($newFilter->get_more_option) == 1){
            $newFilter['greyscale'] = $filterData->greyscale;
            $newFilter['flip_state'] = $filterData->flip_state;
            $newFilter['flip_v'] = $filterData->flip_v;

            if($filterData->blur_size > 0){
                $newFilter['blur'] = $filterData->blur;
                $newFilter['blur_size'] = $filterData->blur_size;

            }
            if($filterData->pixelate_size > 0){
                $newFilter['pixelate'] = $filterData->pixelate;
                $newFilter['pixelate_size'] = $filterData->pixelate_size;
            }
        }

        if(intval($newFilter->get_watermark) == 1 and $filterData->watermark_state == 1 ){
            $newFilter['watermark_state'] = $filterData->watermark_state;
            $newFilter['watermark_img'] = $filterData->watermark_img;
            $newFilter['watermark_position'] = $filterData->watermark_position;
        }

        return $newFilter;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setUploadDirIs
    public function setUploadDirIs(mixed $UploadDirIs): void
    {

        $fullPath = public_path($UploadDirIs);
        if(!File::isDirectory($fullPath)){
            File::makeDirectory($fullPath, 0777, true, true);
        }
        $this->UploadDirIs = $UploadDirIs;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getFileExtension
    static function getFileExtension($file,$filterData)
    {
        $soursFileExtension = $file->extension();

        if( $filterData->convert_state == '1'){
            $soursFileExtension = "webp";
        }
        return $soursFileExtension ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getNewName
    static function getNewName($FileExtension,$newName,$UploadDirIs){

        if($newName == null){
            $newName = time()."_".Str::random(15)."_".'.'.$FileExtension;
        }else{
            // Str::random(10);
            $newName = AdminHelper::Url_Slug($newName).'.'.$FileExtension;
        }
        $newName =  AdminHelper::file_newname($UploadDirIs,$newName);
        return $newName ;
    }
}
