<?php

namespace App\Http\Controllers\admin\config;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\LangFileRequest;
use App\Models\admin\config\Amenity;
use App\Models\admin\config\LangFile;
use App\Models\admin\config\LangFileTranslation;
use App\Models\admin\config\LangPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class LangFileController extends AdminMainController
{
    public $controllerName = 'adminlang';




    public function index888(){
        $data = [];
        $ar = File::getRequire(resource_path('lang/ar/defVal.php'));
        $en = File::getRequire(resource_path('lang/en/defVal.php'));


        $data = array_merge($en,$ar);



    }







#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create()
    {
        $rowData = LangFile::findOrNew(0);
        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Add";
        $langPath = LangPath::all();
        return view('admin.config.lang_form',compact('pageData','rowData','langPath'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function edit($id)
    {
        $rowData = LangFile::findOrFail($id);

        $pageData = AdminHelper::returnPageDate($this->controllerName);
        $pageData['ViewType'] = "Edit";
        $langPath = LangPath::all();
        return view('admin.config.lang_form',compact('rowData','pageData','langPath'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id)
    {
        $deleteRow = LangFile::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('adminlang.index'))
            ->with('confirmDelete',__('general.alertMass.confirmDelete'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(LangFileRequest $request, $id=0)
    {
        $request-> validated();

        $saveData =  LangFile::findOrNew($id);
        $saveData->file_id = $request->file_id;
        $saveData->lang_key = $request->lang_key;
        $saveData->type = $request->type;

        $saveData->save();

        foreach ( config('app.lang_file') as $key=>$lang) {
            $saveTranslation = LangFileTranslation::where('lang_id',$saveData->id)->where('locale',$key)->firstOrNew();
            $saveTranslation->lang_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->name = $request->input($key.'.name');
            $saveTranslation->save();
        }

        if($id == '0'){
           // return  back()->with('Add.Done',__('general.alertMass.confirmAdd'));
            return redirect(route('adminlang.index'))
                ->with('Add.Done',__('general.alertMass.confirmAdd'));
        }else{
            return redirect(route('adminlang.index'))
                ->with('Edit.Done',__('general.alertMass.confirmEdit'));
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create


    public function indexXXXX(){
        $thisIsTest = false;


        $getAllFileList = LangPath::where('id','!=',0)->get();

        foreach ( config('app.lang_file') as $key=>$lang) {
            foreach ($getAllFileList as $filebath){
                $FullPathToFile = LangFileController::getFullPathToFile($filebath,$key);

                if($thisIsTest){
                    echo $filebath->id;
                    echo $filebath->file_name;
                    echo  '<br>';
                    echo $FullPathToFile;
                    echo '<br>';
                }

                $content ="";
                $contentAsArr =[];
                $getAddKeys = LangFile::where('file_id','=',$filebath->id)->get();
                if(count($getAddKeys) == '0'){
                    $content = "<?php\n\nreturn\n[\n"."];";
                }else{
                     $content = "<?php\n\nreturn\n[\n";
                     foreach ($getAddKeys as $addKeys ){
                         $contentAsArr += [$addKeys->lang_key,$addKeys->translate($key)->name];

                         $content .= "\t'".$addKeys->lang_key."' => '".$addKeys->translate($key)->name."',\n";
                     }
                    $content .= "];";
                }

                if(!File::isDirectory($FullPathToFile)){

/*
                    $str = file_get_contents($FullPathToFile);
                    $lang = [];
                    foreach (explode("\n", $str) as $line)
                    {
                        if (strpos($line, '=>') === false)
                        {
                            continue;
                        }

                        list($key, $value) = explode('=>', $line);
                        $lang[trim($key,'\' ')] = trim(trim($value), '\',');
                    }

                    echo $FullPathToFile;
                    echo '<br>';

                    var_dump($lang);
                    echo '<br>';

                    var_dump($contentAsArr);
                    echo '<br>';
*/
                    File::put($FullPathToFile,$content);
                }
            }
        }
    }



    static function getFullPathToFile($row,$key){
        if($row->group != null){
            $groupFolder = $row->group."/" ;

            $fullPath = resource_path("lang/$key/". $row->group);
            if(!File::isDirectory($fullPath)){
                File::makeDirectory($fullPath, 0777, true, true);
            }

        }else{
            $groupFolder = "";
        }

        if($row->sub_dir != null ){
            $subDirFolder = $row->sub_dir."/" ;

            $fullPathSubDir = resource_path("lang/$key/". $row->group."/".$row->sub_dir);
            if(!File::isDirectory($fullPathSubDir)){
                File::makeDirectory($fullPathSubDir, 0777, true, true);
            }

        }else{
            $subDirFolder = "";
        }

        $saveFileName =  $row->file_name.".php";

        $fullPathFile = resource_path("lang/$key/".$groupFolder.$subDirFolder.$saveFileName);
        return $fullPathFile ;
    }
























    public function index_last()
    {

         $selectFileGroup = LangFile::select('file_name')->groupBy('file_name')->get();

         foreach ($selectFileGroup as $fileName){
             $thisFileName = $fileName->file_name ;
             echo $thisFileName ;
             echo  '<br>';
             $selectLangByFileName = LangFile::where('file_name','=',$thisFileName)->get();
/*
 *
 *
             $cc = LangFileController::getFullPathToFile($fileName,'ar');
             echo $cc ;
             echo  '<br>';



             foreach ($selectLangByFileName as $row){

                 $cc = LangFileController::getFullPathToFile($row,'ar');
                 echo $cc ;
                 echo  '<br>';
             }



             echo count($selectLangByFileName) ;
             echo  '<br>';


             #echo  '<br>';
*/
         }
    }





    public function index_xx()
    {
       $rowData = LangFile::orderBy('id')->paginate(20);

        foreach ( config('app.lang_file') as $key=>$lang) {
            foreach ($rowData as $row){
                $fullPath = resource_path("lang/$key/". $row->group);
                if(!File::isDirectory($fullPath)){
                    File::makeDirectory($fullPath, 0777, true, true);
                }
            }
        }
        foreach ( config('app.lang_file') as $key=>$lang) {
            foreach ($rowData as $row){
                $fullPathSubDir = resource_path("lang/$key/". $row->group."/".$row->sub_dir);
                if(!File::isDirectory($fullPathSubDir)){
                    File::makeDirectory($fullPathSubDir, 0777, true, true);
                }
            }
        }
        foreach ( config('app.lang_file') as $key=>$lang) {
            foreach ($rowData as $row){

                if($row->group != null){
                    $groupFolder = $row->group."/" ;
                }else{
                    $groupFolder = "";
                }

                if($row->sub_dir != null){
                    $subDirFolder = $row->sub_dir."/" ;
                }else{
                    $subDirFolder = "";
                }

                $saveFileName =  $row->file_name.".php";




                $fullPathFile = resource_path("lang/$key/".$groupFolder.$subDirFolder.$saveFileName);

                if(!File::isDirectory($fullPathFile)){
                    File::put($fullPathFile,'');
                }






                echo $fullPathFile ;
                echo  "<br>";
            }
        }




        $content = "<?php\n\nreturn\n[\n";
        foreach ($rowData as $row){
            $content .= "\t'".$row->lang_key."' => '".$row->translate('ar')->name."',\n";
        }
        $content .= "];";
        $fullPathFile = resource_path('lang/ar/admin/config/file_name.php');
        File::put($fullPathFile,$content);

    }






    /**
     * Store a newly created resource in storage.
     */









}
