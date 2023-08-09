<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Phattarachai\LaravelMobileDetect\Agent;

class WebMainController extends Controller
{

    public function __construct()
    {
        $agent = new Agent();
        View::share('agent', $agent);
    }




    //
    static function printSeoMeta($row){
        $lang = thisCurrentLocale();
        SEOMeta::setTitle($row->translate($lang)->name ?? "");
        SEOMeta::setDescription($row->translate($lang)->g_des ?? "");
        SEOMeta::addMeta('article:published_time', $row->published_at ?? "" , 'property');
    }


}
