<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\config\UploadFilter;
use Illuminate\Support\Facades\View;

class AdminMainController extends Controller
{


    public function __construct(

    )
    {
        $this->middleware('auth');


        View::share('filterTypes', UploadFilter::all());
        $modelsNameArr = [
            "1"=> ['id'=>'1','name'=>__('admin/config/roles.model_1')],
            "2"=> ['id'=>'2','name'=>__('admin/config/roles.model_2')],
            "3"=> ['id'=>'3','name'=>__('admin/config/roles.model_3')],
            "4"=> ['id'=>'4','name'=>__('admin/config/roles.model_4')],
            "5"=> ['id'=>'5','name'=>__('admin/config/roles.model_5')],
        ];

        View::share('modelsNameArr', $modelsNameArr);
    }



}
