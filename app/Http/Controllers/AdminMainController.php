<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\config\UploadFilter;
use Illuminate\Support\Facades\View;

class AdminMainController extends Controller
{

    public $pageData ;
    public function __construct(
        $pageData = array() ,
    )
    {
        $this->middleware('auth');
       // $filterTypes = UploadFilter::all();

        $this->pageData = $pageData ;

        View::share('filterTypes', UploadFilter::all());
    }


    static function setPageData($controllerName,$sendArr=array()){

        $selMenu = AdminHelper::arrIsset($sendArr,'selMenu',"");
        $prefix = AdminHelper::arrIsset($sendArr,'prefix','admin.');
        $TitlePage = AdminHelper::arrIsset($sendArr,'TitlePage','');
        $ListPage = AdminHelper::arrIsset($sendArr,'ListPage',__('admin/page.page_list'));
        $AddPage = AdminHelper::arrIsset($sendArr,'AddPage',__('admin/page.page_add'));
        $EditPage = AdminHelper::arrIsset($sendArr,'EditPage',__('admin/page.page_edit'));
       // $controllerName = $this->co

        $data = [];
        $data['ControllerName'] = $controllerName;
        $data['TitlePage'] = $TitlePage ;

        $data['ListPageName'] = $ListPage ;
        $data['ListPageUrl'] = route($selMenu. ($controllerName) . '.index');


        $data['AddPageName'] = $AddPage;
        $data['AddPageUrl'] = route($selMenu.($controllerName) . '.create');


        $data['EditPageName'] = $EditPage;

        return $data;
    }
}
