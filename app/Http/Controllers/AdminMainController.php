<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Models\admin\config\UploadFilter;
use App\Models\admin\Developer;
use App\Models\admin\Listing;
use App\Models\admin\Post;
use Cache;
use Illuminate\Support\Facades\View;
use Spatie\Valuestore\Valuestore;

class AdminMainController extends Controller
{

    public $modelSettings;

    public function __construct(

    )
    {

       // Cache::flush();
        $this->middleware('auth');


        View::share('filterTypes', UploadFilter::cash_UploadFilter());

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
            "15"=> ['id'=>'15','name'=>__('admin/config/roles.model_15')],
            "16"=> ['id'=>'16','name'=>__('admin/config/roles.model_16')],
            "17"=> ['id'=>'17','name'=>__('admin/config/roles.model_17')],
            "18"=> ['id'=>'18','name'=>__('admin/config/roles.model_18')],
            "19"=> ['id'=>'19','name'=>__('admin/config/roles.model_19')],
            "20"=> ['id'=>'20','name'=>__('admin/config/roles.model_20')],
            "21"=> ['id'=>'21','name'=>__('admin/config/roles.model_21')],

        ];
        View::share('modelsNameArr', $modelsNameArr);

        $FilterTypeArr = [
            "1"=> ['id'=>'1','name'=>__('admin/config/upFilter.filter_action_1')],
            "2"=> ['id'=>'2','name'=>__('admin/config/upFilter.filter_action_2')],
            "3"=> ['id'=>'3','name'=>__('admin/config/upFilter.filter_action_3')],
            "4"=> ['id'=>'4','name'=>__('admin/config/upFilter.filter_action_4')],
            "5"=> ['id'=>'5','name'=>__('admin/config/upFilter.filter_action_5')],
        ];
        View::share('filterTypeArr', $FilterTypeArr);

        $OrderByArr = [
            "1"=> ['id'=>'1','name'=> __('admin/config/settings.sort_id_DESC')],
            "2"=> ['id'=>'2','name'=> __('admin/config/settings.sort_id_ASC')],
            "3"=> ['id'=>'3','name'=> __('admin/config/settings.sort_name_DESC')],
            "4"=> ['id'=>'4','name'=> __('admin/config/settings.sort_name_ASC')],
        ];
        View::share('OrderByArr', $OrderByArr);


        $modelSettings = Valuestore::make(config_path(config('app.model_settings_name')));
        $modelSettings = $modelSettings->all();
        $this->modelSettings = $modelSettings ;
        View::share('modelSettings', $modelSettings);

        $ProjectsTypeArr = [
            "1"=> ['id'=>'compound','name'=> 'Compounds' ],
            "2"=> ['id'=>'village','name'=> 'Villages' ],
            "3"=> ['id'=>'resort','name'=> 'Resorts' ],
        ];
        View::share('ProjectsTypeArr', $ProjectsTypeArr);

        $Property_TypeArr = [
            "1"=> ['id'=>'apartment','name'=> 'Apartment' ],
            "2"=> ['id'=>'duplex','name'=> 'Duplex' ],
            "3"=> ['id'=>'studio','name'=> 'Studio' ],
            "4"=> ['id'=>'town-house','name'=> 'Town House' ],
            "5"=> ['id'=>'twin-house','name'=> 'Twin House' ],
            "6"=> ['id'=>'pent-house','name'=> 'Pent House' ],
            "7"=> ['id'=>'villa','name'=> 'Villa' ],
            "8"=> ['id'=>'office','name'=> 'Office' ],
            "9"=> ['id'=>'store','name'=> 'Store' ],
            "10"=> ['id'=>'chalet','name'=> 'Chalet' ],
            "11"=> ['id'=>'chalet-with-garden','name'=> 'Chalet with garden' ],
            "12"=> ['id'=>'pharmacy','name'=> 'Pharmacy' ],
            "13"=> ['id'=>'clinic','name'=> 'Clinic' ],
            "14"=> ['id'=>'laboratory','name'=> 'Laboratory' ],
        ];
        View::share('Property_TypeArr', $Property_TypeArr);

        $ListingView_Arr = [
            "1"=> ['id'=>'main-street','name'=> 'Main Street' ],
            "2"=> ['id'=>'seaview','name'=> 'Seaview' ],
            "3"=> ['id'=>'lakeview','name'=> 'Lakeview' ],
            "4"=> ['id'=>'nileview','name'=> 'Nileview' ],
        ];
        View::share('ListingView_Arr', $ListingView_Arr);


        $UnitSatues_Arr = [
            "1"=> ['id'=>'1','name'=> 'Primary' ],
            "2"=> ['id'=>'2','name'=> 'Reseller' ],

        ];
        View::share('UnitSatues_Arr', $UnitSatues_Arr);

        $ProjectSatues_Arr = [
            "1"=> ['id'=>'under-construction','name'=> 'Under Construction' ],
            "2"=> ['id'=>'completed','name'=> 'Completed' ],

        ];
        View::share('ProjectSatues_Arr', $ProjectSatues_Arr);

        $ProjectType_Arr = [
            "1"=> ['id'=>'residential','name'=> 'Residential' ],
            "2"=> ['id'=>'vacation','name'=> 'Vacation' ],
            "3"=> ['id'=>'commercial','name'=> 'Commercial' ],
            "4"=> ['id'=>'medical','name'=> 'Medical' ],

        ];
        View::share('ProjectType_Arr', $ProjectType_Arr);




    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefSetting
    public function getDefSetting($controllerName,$key,$def){
        if(isset($this->modelSettings[$controllerName.$key])){
            return $this->modelSettings[$controllerName.$key];
        }else{
            return $def;
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getSelect
    public function getSelectQuery($query){
        $controllerName = $this->controllerName;

        $perPage = self::getDefSetting($controllerName,'_perpage','5');
        $dataTable =  self::getDefSetting($controllerName,'_datatable','0');
        $orderBy =  self::getDefSetting($controllerName,'_orderby','1');



        switch ($orderBy){
            case 1:
                $query->orderBy('id','DESC');
                break;
            case 2:
                $query->orderBy('id','ASC');
                break;
            case 3:
                $query->orderByTranslation('name','DESC');
                break;
            case 4:
                $query->orderByTranslation('name','ASC');
                break;
            default:
        }
        if($dataTable == '1'){
            return $query->get();
        }else{
            return $query->paginate($perPage);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text

    public function Home()
    {





        $PostsCount = Cache::remember('PostsCount_Cash',config('app.def_24h_cash'), function (){
            return  [
                'all'=> Post::withTrashed()->count(),
                'Trashed'=> Post::onlyTrashed()->count(),
                'noPhoto'=> Post::withTrashed()->where('photo',null)->count(),
                'slugErr'=> Post::withTrashed()->where('slug_count','>',1)->count(),
                'unActive'=> Post::withTrashed()->where('is_published',false)->count(),
                'noEn'=> Post::withTrashed()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                'noAr'=> Post::withTrashed()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
            ];
        });

        $DevelopersCount = Cache::remember('DevelopersCount_Cash',config('app.def_24h_cash'), function (){
            return  [
                'all'=> Developer::withTrashed()->count(),
                'Trashed'=> Developer::onlyTrashed()->count(),
                'noPhoto'=> Developer::withTrashed()->where('photo',null)->count(),
                'slugErr'=> Developer::withTrashed()->where('slug_count','>',1)->count(),
                'unActive'=> Developer::withTrashed()->where('is_active',false)->count(),
                'noEn'=> Developer::withTrashed()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                'noAr'=> Developer::withTrashed()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
            ];
        });


        $ProjectsCount = Cache::remember('ProjectsCount_Cash',config('app.def_24h_cash'), function (){
            return  [
                'all'=> Listing::withTrashed()->Project()->count(),
                'Trashed'=> Listing::onlyTrashed()->Project()->count(),
                'noPhoto'=> Listing::withTrashed()->Project()->where('photo',null)->count(),
                'slugErr'=> '0',
                'unActive'=> Listing::withTrashed()->Project()->where('is_published',false)->count(),
                'noEn'=> Listing::withTrashed()->Project()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                'noAr'=> Listing::withTrashed()->Project()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
            ];
        });


        $ProjectUnitsCount = Cache::remember('ProjectUnitsCount_Cash',config('app.def_24h_cash'), function (){
            return  [
                'all'=> Listing::withTrashed()->unit()->count(),
                'Trashed'=> Listing::onlyTrashed()->unit()->count(),
                'noPhoto'=> Listing::withTrashed()->unit()->where('photo',null)->count(),
                'slugErr'=> '0',
                'unActive'=> Listing::withTrashed()->unit()->where('is_published',false)->count(),
                'noEn'=> Listing::withTrashed()->unit()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                'noAr'=> Listing::withTrashed()->unit()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
            ];
        });

        $ForSaleCount = Cache::remember('ForSaleCount_Cash',config('app.def_24h_cash'), function (){
            return  [
                'all'=> Listing::withTrashed()->ForSale()->count(),
                'Trashed'=> Listing::onlyTrashed()->ForSale()->count(),
                'noPhoto'=> Listing::withTrashed()->ForSale()->where('photo',null)->count(),
                'slugErr'=> '0',
                'unActive'=> Listing::withTrashed()->ForSale()->where('is_published',false)->count(),
                'noEn'=> Listing::withTrashed()->ForSale()->whereHas('teans_en', function ($query) {$query->where('des', '=', null);})->count(),
                'noAr'=> Listing::withTrashed()->ForSale()->whereHas('teans_ar', function ($query) {$query->where('des', '=', null);})->count(),
            ];
        });


      return view('admin.dashbord',compact('PostsCount','DevelopersCount','ProjectsCount','ForSaleCount','ProjectUnitsCount'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     text
    public function Update()
    {

        Cache::forget('PostsCount_Cash');
        Cache::forget('DevelopersCount_Cash');
        Cache::forget('ProjectsCount_Cash');
        Cache::forget('ProjectUnitsCount_Cash');
        Cache::forget('ForSaleCount_Cash');

        return back();
    }

/*







#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     unActive
    public function unActive()
    {


        $sendArr = ['TitlePage' => __('admin/menu.post'),'restore'=> 1 ];
        $pageData = AdminHelper::returnPageDate($this->controllerName,$sendArr);
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Post::onlyTrashed()->count();

        $Posts = self::getSelectQuery( Post::where('id',"!=","0")->->with('getMorePhoto'));

        return view('admin.post.post_index',compact('pageData','Posts'));



    }

 */








}
