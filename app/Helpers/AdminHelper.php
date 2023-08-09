<?php
namespace App\Helpers;

use App\Http\Controllers\WebMainController;
use App\Models\admin\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminHelper{

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     thisCurrentLocale
    public static function thisCurrentLocale(){
        return LaravelLocalization::getCurrentLocale();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       detectFlag
    public static function detectFlag($regional){
        $data = [];
        if (!empty($regional)) {
            $regional = Str::lower($regional);
            $regional = explode("_", $regional);
            $data['flagName'] = $regional[1];
            $data['flagIcon'] = '<i class="flag-icon flag-icon-' . $data['flagName'] . '  mr-2"></i>';
        } else {
            $data['flagIcon'] = '<i class="flag-icon flag-icon-' . 'eg' . '  mr-2"></i>';
        }
        #return $flagIcon;
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     returnPageDate
    public static function returnPageDate($controllerName,$sendArr=array()){

        $selMenu = AdminHelper::arrIsset($sendArr,'selMenu',"");
        $prefix = AdminHelper::arrIsset($sendArr,'prefix','admin.');
        $TitlePage = AdminHelper::arrIsset($sendArr,'TitlePage','');
        $ListPage = AdminHelper::arrIsset($sendArr,'ListPage',__('admin/page.page_list'));
        $AddPage = AdminHelper::arrIsset($sendArr,'AddPage',__('admin/page.page_add'));
        $EditPage = AdminHelper::arrIsset($sendArr,'EditPage',__('admin/page.page_edit'));
        $restore = AdminHelper::arrIsset($sendArr,'restore','0');
        $more_photo = AdminHelper::arrIsset($sendArr,'more_photo','0');

        $data = [];
        $data['ControllerName'] = $controllerName;
        $data['TitlePage'] = $TitlePage ;

        $data['ListPageName'] = $ListPage ;
        $data['ListPageUrl'] = route($selMenu. ($controllerName) . '.index');


        $data['AddPageName'] = $AddPage;
        $data['AddPageUrl'] = route($selMenu.($controllerName) . '.create');


        $data['EditPageName'] = $EditPage;
        $data['AddRole'] = $controllerName."_add" ;

        if($restore == 1){
            $data['RestoreRole'] = $controllerName."_restore" ;
            $data['RestoreUrl'] = route($selMenu.($controllerName) . '.SoftDelete');
        }


        return $data;
    }

    public static function returnPageDate_old($controllerName,$prefix='admin.',$selMenu=''){
        $data = [];
        $data['ControllerName'] = $controllerName;
        $data['TitlePage'] = __($prefix.($controllerName) . '.main.title');

        $data['ListPageName'] = __($prefix.($controllerName) . '.main.listPage');
        $data['ListPageUrl'] = route($selMenu. ($controllerName) . '.index');


        $data['AddPageName'] = __($prefix.($controllerName) . '.main.addPage');
        $data['AddPageUrl'] = route($selMenu.($controllerName) . '.create');


        $data['EditPageName'] = __($prefix.($controllerName) . '.main.editPage');

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     error
    public static function error($value, $name, $label){
        $newName = trim(str_replace('_', " ", $name));

        return str_replace($newName, $label, $value);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     file_newname
    static function file_newname($path, $filename){
        if ($pos = strrpos($filename, '.')) {
            $name = substr($filename, 0, $pos);
            $ext = substr($filename, $pos);
        } else {
            $name = $filename;
        }

        $newpath = $path.'/'.$filename;
        $newname = $filename;
        $counter = 0;
        while (file_exists($newpath)) {
            $newname = $name .'_'. $counter . $ext;
            $newpath = $path.'/'.$newname;
            $counter++;
        }

        return $newname;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     hex2rgb
    static function hex2rgb($hex,$opacity=".5") {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        return array($r, $g, $b,$opacity); // RETURN ARRAY INSTEAD OF STRING
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     arrIsset
    static function arrIsset($Arr,$Name,$DefVall=""){
        if(isset($Arr[$Name])){
            $SendVal = $Arr[$Name] ;
        }else{
            $SendVal  = $DefVall;
        }
        return  $SendVal ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     LoadCssFile
    static function  LoadCssFile($Path, $web = "1"){
        $buffer = file_get_contents(static_asset($Path));
        $def = static_asset("assets/fonts/");
        $rep1 = array(
            "../fonts/",
        );
        $rep2 = array(
            static_asset("assets/fonts/") . "/",
        );
        $buffer = str_replace($rep1, $rep2, $buffer);
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(': ', ':', $buffer);
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

        if ($web == "1") {
            echo '<style>';
            echo($buffer);
            echo '</style>';
        } else {
            echo '<link rel="stylesheet" href="' . static_asset($Path) . '">' . PHP_EOL;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     generateEAN
    static function  generateEAN($number){
        $code = '200' . str_pad($number, 9, '0');
        $weightflag = true;
        $sum = 0;
        // Weight for a digit in the checksum is 3, 1, 3.. starting from the last digit.
        // loop backwards to make the loop length-agnostic. The same basic functionality
        // will work for codes of different lengths.
        for ($i = strlen($code) - 1; $i >= 0; $i--) {
            $sum += (int)$code[$i] * ($weightflag ? 3 : 1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        return $code;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Url_Slug
    static function Url_Slug($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
       // $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $str = mb_convert_encoding((string)$str, 'UTF-8');


        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',

            // Latin symbols
            '©' => '(c)',

            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',

            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',

            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',

            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     formatSizeUnits
    static function formatSizeUnits($bytes,$sendArr=array()){
        $PrintMass = self::arrIsset($sendArr,'PrintMass','1');
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            if($PrintMass == '1'){
                $bytesCount = number_format($bytes / 1024, 2);
                if($bytesCount < 50){
                    $bytes = '<span class="btn-success rounded p-1">'. $bytesCount .' KB</span>';
                }elseif ($bytesCount <= 100 ){
                    $bytes = '<span class="btn-warning rounded p-1">'. $bytesCount .' KB</span>';
                }else{
                    $bytes = '<span class="btn-danger rounded p-1">'. $bytesCount .' KB</span>';
                }
            }else{
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            }
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text
    static function createDirecrotory($uploadDir)
    {
        $fullPath = public_path($uploadDir);
        if(!File::isDirectory($fullPath)){
            File::makeDirectory($fullPath, 0777, true, true);
        }

        return $uploadDir ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #getImageWatermark
    static function getImageWatermark($path){
        $img = Image::make(public_path($path));
        return $img ;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     saveAndDeletePhoto
    static function saveAndDeletePhoto($saveData,$saveImgData){

        if(count( $saveImgData->sendSaveData) != 0){

            if(File::exists($saveData->photo)){
                File::delete($saveData->photo);
            }
            $saveData->photo = $saveImgData->sendSaveData['photo']['file_name'];

            if($saveImgData->setCountOfUpload >= 2){
                if(File::exists($saveData->photo_thum_1)){
                    File::delete($saveData->photo_thum_1);
                }
                if(isset($saveImgData->sendSaveData['photo_thum_1'])){
                    $saveData->photo_thum_1 = $saveImgData->sendSaveData['photo_thum_1']['file_name'];
                }else{
                    $saveData->photo_thum_1 = null;
                }
            }

            if($saveImgData->setCountOfUpload >= 3){
                if(File::exists($saveData->photo_thum_2)){
                    File::delete($saveData->photo_thum_2);
                }
                if(isset($saveImgData->sendSaveData['photo_thum_2'])){
                    $saveData->photo_thum_2 = $saveImgData->sendSaveData['photo_thum_2']['file_name'];
                }else{
                    $saveData->photo_thum_2 = null;
                }
            }

        }
        return $saveData ;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     saveAndDeletePhoto
    static function saveAndDeletePhotoByOne($saveData,$saveImgData,$FildName){
        if(isset($saveImgData->sendSaveData['photo']['file_name'])){
            if(File::exists($saveData->$FildName)){
                File::delete($saveData->$FildName);
            }
            $saveData->$FildName = $saveImgData->sendSaveData['photo']['file_name'];
        }
        return $saveData ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     onlyDeletePhotos
    static function onlyDeletePhotos($deleteRow,$Num=2){

        if(File::exists($deleteRow->photo)){
            File::delete($deleteRow->photo);
        }

        if( $Num >= 2){
            if(File::exists($deleteRow->photo_thum_1)){
                File::delete($deleteRow->photo_thum_1);
            }
        }

        if($Num >= 3){
            if(File::exists($deleteRow->photo_thum_2)){
                File::delete($deleteRow->photo_thum_2);
            }
        }

        return $deleteRow ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     onlyDeletePhotos
    static function DeleteAllPhotos($deleteRow,$emptyTable=false,$Names=['photo','photo_thum_1','photo_thum_1']){

        foreach ($Names as $name){

            if(File::exists($deleteRow->$name)){
                File::delete($deleteRow->$name);
            }

            if($emptyTable){
                $deleteRow->$name  = '';
            }

        }
        return $deleteRow ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printTableImage
    static  function printTableImage($row,$fildeName='photo_thum_1'){
        if($row->$fildeName){
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="'.defImagesDir($row->$fildeName).'">';
        }else{
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="'.defAdminAssets('img/default-150x150.png').'">';
        }

        return $sendImg ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printTableImage
    static  function printUserPhoto($fildeName='photo_thum_1'){
        if(Auth::user()->$fildeName){
            $sendImg = defImagesDir(Auth::user()->$fildeName) ;
        }else{
            $sendImg = defAdminAssets('img/user_avatar.jpg');
        }
        return $sendImg ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Text



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     printTableImage
    static  function printWebImage($row,$fildeName,$defPhoto,$sendArr=array()){
        $defPhoto_file = WebMainController::getDefPhotoById($defPhoto);

        if($row->$fildeName){
            $sendImg = '<img  class="img-fluid" src="'.defImagesDir($row->$fildeName).'" >';
        }else{
            $sendImg = '<img  class="img-fluid" src="'.defImagesDir($defPhoto_file->photo).'">';
        }

        return $sendImg ;
    }

}
