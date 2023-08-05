<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class WebMainController extends Controller
{
    //
    static function printSeoMeta($row){
        $lang = thisCurrentLocale();
        SEOMeta::setTitle($row->translate($lang)->name ?? "");
        SEOMeta::setDescription($row->translate($lang)->g_des ?? "");
        SEOMeta::addMeta('article:published_time', $row->published_at ?? "" , 'property');
    }


}
