<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\config\DefPhoto;
use App\Models\admin\config\MetaTag;

use App\Models\admin\config\Setting;
use App\Models\admin\Location;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Phattarachai\LaravelMobileDetect\Agent;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class WebMainController extends Controller
{

    public function __construct()
    {
        $agent = new Agent();
        View::share('agent', $agent);



    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    static function printSeoMeta($row,$defPhoto="logo",$sendArr=array()){
        $lang = thisCurrentLocale();

        $type = AdminHelper::arrIsset($sendArr,'type','website');
        $siteName = self::getWebConfig();

        if($row->photo){
            $defImage = $row->photo ;
        }else{
            $GetdefImage = self::getDefPhotoById($defPhoto);
            $defImage =optional($GetdefImage)->photo;
        }
        if($defImage){
            $defImage = defImagesDir($defImage);
        }

        SEOMeta::setTitle($row->translate($lang)->g_title ?? "");
        SEOMeta::setDescription($row->translate($lang)->g_des ?? "");
        SEOMeta::addMeta('article:published_time', $row->published_at ?? "" , 'property');

        OpenGraph::setTitle($row->translate($lang)->g_title ?? "");
        OpenGraph::setDescription($row->translate($lang)->g_des ?? "" );
        OpenGraph::addProperty('type', $type);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addImage($defImage);
        OpenGraph::setSiteName($siteName->translate($lang)->name ?? "");

        TwitterCard::setTitle($row->translate($lang)->g_title ?? "");
        TwitterCard::setDescription($row->translate($lang)->g_des ?? "");
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage($defImage);
        TwitterCard::setImage($defImage);
        TwitterCard::setType('summary_large_image');


    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getMeatByCatId
    static function getMeatByCatId($cat_id){

        $WebMeta = Cache::remember('WebMeta_Cash',config('app.meta_tage_cash'), function (){
            return  MetaTag::with('translation')->get()->keyBy('cat_id');
        });

        if ($WebMeta->has($cat_id)) {
            return $WebMeta[$cat_id] ;
        }else{
            return $WebMeta['home'] ;
        }
   }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefPhotoById
    static function getDefPhotoById($cat_id){

        $DefPhoto = Cache::remember('DefPhoto_Cash',config('app.def_photo_cash'), function (){
            return  DefPhoto::get()->keyBy('cat_id');
        });

        if ($DefPhoto->has($cat_id)) {
            return $DefPhoto[$cat_id] ;
        }else{
            return $DefPhoto['logo'] ;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getWebConfig
    static function getWebConfig(){
        $WebConfig = Cache::remember('WebConfig_Cash',config('app.website_config_cash'), function (){
            return  Setting::where('id' , 1)->with('translation')->first();
        });
        return $WebConfig ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text






#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

}
