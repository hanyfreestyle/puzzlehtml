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
            "6"=> ['id'=>'6','name'=>__('admin/config/roles.model_6')],
            "7"=> ['id'=>'7','name'=>__('admin/config/roles.model_7')],
            "8"=> ['id'=>'8','name'=>__('admin/config/roles.model_8')],
            "9"=> ['id'=>'9','name'=>__('admin/config/roles.model_9')],
            "10"=> ['id'=>'10','name'=>__('admin/config/roles.model_10')],
            "11"=> ['id'=>'11','name'=>__('admin/config/roles.model_11')],
            "12"=> ['id'=>'12','name'=>__('admin/config/roles.model_12')],
            "13"=> ['id'=>'13','name'=>__('admin/config/roles.model_13')],
            "14"=> ['id'=>'14','name'=>__('admin/config/roles.model_14')],
        ];

        View::share('modelsNameArr', $modelsNameArr);
    }



}
