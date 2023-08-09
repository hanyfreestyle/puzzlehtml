<?php

namespace App\Http\Controllers\admin\config;

use App\Http\Controllers\AdminMainController;
use App\Http\Requests\admin\config\LangFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class LangFileWebController extends AdminMainController
{
    public $controllerName ;

    function __construct($controllerName = 'weblang')
    {
        parent::__construct();

        $this->controllerName = $controllerName;
        $this->middleware('permission:'.$controllerName.'_view', ['only' => ['index']]);
        $this->middleware('permission:'.$controllerName.'_edit', ['only' => ['updateFile']]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index()
    {
        $listFile =  config('adminLangFile.webFile');


        $pageData = "";
        $mergeData = [];
        $allData = [];
        $prefixCopy = "";
        $ViewData = 0;


        if(isset($_GET['id']) and intval($_GET['id']) != '0' and intval($_GET['id']) <= count($listFile) ){
            $ViewData = '1';
            $id = intval($_GET['id']);

            $selFileIs =  $listFile[$id]['file_name'];
            $prefixCopy = LangFileWebController::getPrefixCopy($listFile[$id]);

            foreach ( config('app.lang_file') as $key=>$lang) {
                $FullPathToFile  = LangFileWebController::getFullPathToFileArr($listFile[$id],$key);
                $GetData = File::getRequire($FullPathToFile);
                $result = array();

                foreach ($GetData as $Mainkey => $value) {

                    if (is_array($value)) {

                        $newSubArr = [];
                        foreach ($value as $subKey => $subvalue){
                            $newSubArr += [$Mainkey."_".$subKey => $subvalue ];
                        }
                        $result = array_merge($result, $newSubArr);
                    }
                    else {
                        $result[$Mainkey] = $value;
                    }
                }
                $allData += [$key=>$result] ;
                $mergeData = array_merge($mergeData,$result);

            }
        }
        ksort($mergeData);

        return view('admin.config.lang_web_index',compact('pageData','mergeData','allData','prefixCopy','ViewData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     updateFile
    public function updateFile(LangFileRequest $request){
        $request-> validated();

        $id = $request->file_id ;
        $listFile =  config('adminLangFile.webFile');
        $selFileIs =  $listFile[$id]['file_name'];

        $contentAsArr =[];
        foreach ( config('app.lang_file') as $key=>$lang)
        {
            $FullPathToFile = LangFileWebController::getFullPathToFileArr($listFile[$id], $key);


            $content = "<?php\n\nreturn\n[\n";
            $index = 0;
            foreach ($request->key as $keyfromrequest ){
                if(trim($keyfromrequest) != ''){
                    $contentAsArr += [$keyfromrequest => $request->$key[$index]];
                    $content .= "\t'".$keyfromrequest."' => '".htmlentities($request->$key[$index])."',\n";
                }
                $index++ ;
            }
            $content .= "];";
            File::put($FullPathToFile,$content);
        }

        return  back()->with('Update.Done','');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getFullPathToFileArr
    static function getFullPathToFileArr($row,$key){
        if($row['group'] != null){
            $groupFolder = $row['group']."/" ;
            $fullPath = resource_path("lang/$key/". $row['group']);
            if(!File::isDirectory($fullPath)){
                File::makeDirectory($fullPath, 0777, true, true);
            }
        }else{
            $groupFolder = "";
        }

        if($row['sub_dir'] != null ){
            $subDirFolder = $row['sub_dir']."/" ;

            $fullPathSubDir = resource_path("lang/$key/". $row['group']."/".$row['sub_dir']);
            if(!File::isDirectory($fullPathSubDir)){
                File::makeDirectory($fullPathSubDir, 0777, true, true);
            }
        }else{
            $subDirFolder = "";
        }

        $saveFileName =  $row['file_name'].".php";
        $fullPathFile = resource_path("lang/$key/".$groupFolder.$subDirFolder.$saveFileName);
        $filex =   File::isFile($fullPathFile);

        if(!File::isFile($fullPathFile)){
            $content = "<?php\n\nreturn\n[\n";
            $content .= "];";
            File::put($fullPathFile,$content);
        }
        return $fullPathFile ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getPrefixCopy
    static function getPrefixCopy($row){
        $line = "";
        if($row['group'] != null){
            $line .= $row['group']."/";
        }
        if($row['sub_dir'] != null){
            $line .= $row['sub_dir']."/";
        }
        $line .= $row['file_name'].".";
        return $line;
    }

}
