<?php

namespace App\Http\Controllers;

use DirectoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashbord');
    }

    public function TestLang(){
        $dir = resource_path('lang\ar\admin\config');
        $dirs = File::directories($dir);
        $files = File::files($dir);

        foreach ($files as $file){

            echo  $file."<br/>";
        }
        //dd($dirs);





 /*
        $langFile = Lang::get('admin/config/');



        foreach ($langFile as  $key=>$langTxt)
        {
            if (is_array($langTxt))
            {
                foreach ($langTxt as $key_sub => $langTxtsub)
                {
                    echo "------" . $langTxtsub . "<br>";
                }

            } else
            {
                echo $langTxt . "<br>";
            }
        }
*/

    }



}
