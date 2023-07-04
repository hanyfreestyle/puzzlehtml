<?php

namespace App\Helpers;

use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\UploadFilter;
use App\Models\admin\config\UploadFilterSize;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;





class AdminImageUpload  {


    static function UploadOne($request,$sendArr=array())
    {
        $saveData = [];

        $saveDirIs = AdminHelper::arrIsset($sendArr,'saveDirIs','uploads/album/');
        $fileName = AdminHelper::arrIsset($sendArr,'fileName','image');

        $filter_Id = AdminHelper::arrIsset($sendArr,'filter_id',$request->filter_id);



        if (request()->hasFile($fileName)) {

            // مكان الحفظ
           // $saveDirIs = AdminImageUpload::createDirectory($saveDirIs);
            $saveDirIs = self::createDirectory($saveDirIs);

            /// بيانات الفلتر
            $filterData = UploadFilter::find($filter_Id);

            // بيانات الصور الاضافيه
            $filterSizeData = UploadFilterSize::where('filter_id',$filter_Id)->get();

            /// بيانات الملف المرفوع
            $file = $request->file($fileName);

            $FileExtension = self::getFileExtension($file,$filterData);


            /// الصورة الاصلية
            $saveImage =  Image::make($file);


            $newName = self::getNewName($FileExtension,$saveDirIs,$request,$sendArr);



            //$saveImage->filter(new ImageFilters($request->filter_id));
            $saveImage->filter(new ImageFilters($filterData));

            $saveImage->save(public_path($saveDirIs.$newName), $filterData->quality_val, $FileExtension);


            $saveData = [
                'defPhoto' => [
                    "file_original_name"=>$saveImage->filename,
                    "file_name"=>$saveDirIs.$saveImage->basename,
                    "extension"=>$saveImage->extension,
                    "type"=>"image",
                ],
            ];

//dd($filterData);
//dd($filterSizeData);

            if(count($filterSizeData) > 0){
                $index = 1;
                foreach ($filterSizeData as $newFilter ){
                    $saveImage =  Image::make($file);
                    $newName = self::getNewName($FileExtension,$saveDirIs,$request,$sendArr);

                    $saveImage->filter(new ImageFilters($newFilter));

                    $saveImage->save(public_path($saveDirIs.$newName), $filterData->quality_val, $FileExtension);

                    $saveData += [
                        'thumPhoto_'.$index => [
                            "file_original_name"=>$saveImage->filename,
                            "file_name"=>$saveDirIs.$saveImage->basename,
                            "extension"=>$saveImage->extension,
                            "type"=>"image",
                        ],
                    ];

                    $index++;
                }

            }

        }else{
            dd('No Photo');
        }
        return $saveData;
    }

    static function createDirectory($uploadDir)
    {
        $fullPath = public_path($uploadDir);
        if(!File::isDirectory($fullPath)){
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir ;
    }

    static function getFileExtension($file,$filterData)
    {
        $soursFileExtension = $file->extension();

        if( $filterData->convert_state == '1'){
            $soursFileExtension = "webp";
        }
        return $soursFileExtension ;
    }

    static function getNewName($FileExtension,$saveDirIs,$request,$sendArr=array()){

        $newName = AdminHelper::arrIsset($sendArr,'newName','');

        if($newName == ''){
            $newName = time()."_".Str::random(15)."_".'.'.$FileExtension;
        }else{
            // Str::random(10);
            $newName = AdminHelper::Url_Slug($newName).'.'.$FileExtension;
        }

        $newName =  AdminHelper::file_newname($saveDirIs,$newName);

        return $newName ;
    }
}
