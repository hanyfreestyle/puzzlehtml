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
    }



}
