<?php


use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\config\DefPhotoController;
use App\Http\Controllers\admin\config\LangFileController;
use App\Http\Controllers\admin\config\MetaTagController;
use App\Http\Controllers\admin\config\SettingsController;
use App\Http\Controllers\admin\config\UploadFilterController;
use App\Http\Controllers\admin\config\UploadFilterSizeController;
use App\Http\Controllers\admin\roles\AdminPermissionController;
use App\Http\Controllers\admin\roles\AdminRoleController;
use App\Http\Controllers\admin\roles\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController ;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Auth::viaRemember();
//Auth::logoutOtherDevices('password');


Route::group(['middleware' => ['auth','status']], function() {

    Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
        Route::group(['prefix'=>'admin'],function(){

            Route::get('/Home', [HomeController::class, 'index'])->name('admin.Dashboard');
            Route::get('/TestLang', [HomeController::class, 'TestLang'])->name('admin.DashboardXXXX');


            Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('config.web.index');
            Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('admin.webConfigUpdate');

            Route::get('/metaTags', [MetaTagController::class,'index'])->name('config.meta.index');
            Route::get('/metaTags/create', [MetaTagController::class,'create'])->name('config.meta.create');
            Route::post('/metaTags/store/{id}', [MetaTagController::class,'storeUpdate'])->name('config.meta.store');
            Route::get('/metaTags/edit/{id}', [MetaTagController::class,'edit'])->name('config.meta.edit');
            Route::post('/metaTags/Update/{id}', [MetaTagController::class,'storeUpdate'])->name('config.meta.update');
            Route::delete('/metaTags/delete/{id}', [MetaTagController::class,'delete'])->name('config.meta.destroy');

            Route::get('/defPhotos', [DefPhotoController::class,'index'])->name('config.defPhoto.index');
            Route::get('/defPhotos/create', [DefPhotoController::class,'create'])->name('config.defPhoto.create');
            Route::post('/defPhotos/store/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.storeUpdate');
            Route::get('/defPhotos/edit/{id}', [DefPhotoController::class,'edit'])->name('config.defPhoto.edit');
            Route::post('/defPhotos/Update/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.storeUpdate');
            Route::delete('/defPhotos/delete/{id}', [DefPhotoController::class,'destroy'])->name('config.defPhoto.destroy');

            Route::post('/sortDefPhoto/saveSort', [DefPhotoController::class,'sortDefPhotoSave'])->name('config.defPhoto.sortDefPhoto');
            Route::get('/sortDefPhoto/ListAll', [DefPhotoController::class,'sortDefPhotoList'])->name('config.defPhoto.sortDefPhotoList');
            Route::get('/defIcon/show', [DefPhotoController::class,'defIconShow'])->name('config.defIcon.show');

            Route::get('/upFilter', [UploadFilterController::class,'index'])->name('config.upFilter.index');
            Route::get('/upFilter/create', [UploadFilterController::class,'create'])->name('config.upFilter.create');
            Route::post('/upFilter/store/{id}', [UploadFilterController::class,'storeUpdate'])->name('config.upFilter.store');
            Route::get('/upFilter/edit/{id}', [UploadFilterController::class,'edit'])->name('config.upFilter.edit');
            Route::post('/upFilter/Update/{id}', [UploadFilterController::class,'storeUpdate'])->name('config.upFilter.update');
            Route::get('/upFilter/delete/{id}', [UploadFilterController::class,'destroy'])->name('config.upFilter.destroy');

            Route::get('/upFilterSize/create/{filterId}', [UploadFilterSizeController::class,'create'])->name('config.upFilter.size.create');
            Route::post('/upFilterSize/store/{id}', [UploadFilterSizeController::class,'storeUpdate'])->name('config.upFilter.size.storeOrUpdate');
            Route::get('/upFilterSize/edit/{id}', [UploadFilterSizeController::class,'edit'])->name('config.upFilter.size.edit');
            Route::get('/upFilterSize/delete/{id}', [UploadFilterSizeController::class,'destroy'])->name('config.upFilter.size.destroy');


            Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
            Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
            Route::post('/amenity/store/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.store');
            Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
            Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
            Route::delete('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');


            Route::get('/adminlang',[LangFileController::class,'index'])->name('adminlang.index');
            Route::post('/adminlang/updateFile',[LangFileController::class,'updateFile'])->name('adminlang.updateFile');



            Route::get('/Users', [UserController::class,'index'])->name('users.users.index');
            Route::get('/Users/create', [UserController::class,'create'])->name('users.users.create');
            Route::post('/Users/store/{id}', [UserController::class,'storeUpdate'])->name('users.users.store');
            Route::get('/Users/edit/{id}', [UserController::class,'edit'])->name('users.users.edit');
            Route::post('/Users/Update/{id}', [UserController::class,'storeUpdate'])->name('users.users.update');
            Route::get('/Users/delete/{id}', [UserController::class,'destroy'])->name('users.users.destroy');
            Route::post('/Users/updateStatus', [UserController::class,'updateStatus'])->name('users.users.updateStatus');

            Route::get('/Users/emptyPhoto/{id}', [UserController::class,'emptyPhoto'])->name('users.users.emptyPhoto');



            Route::get('/Roles', [AdminRoleController::class,'index'])->name('users.roles.index');
            Route::get('/Roles/create', [AdminRoleController::class,'create'])->name('users.roles.create');
            Route::post('/Roles/store/{id}', [AdminRoleController::class,'storeUpdate'])->name('users.roles.store');
            Route::get('/Roles/edit/{id}', [AdminRoleController::class,'edit'])->name('users.roles.edit');
            Route::post('/Roles/Update/{id}', [AdminRoleController::class,'storeUpdate'])->name('users.roles.update');
            Route::get('/Roles/delete/{id}', [AdminRoleController::class,'destroy'])->name('users.roles.destroy');

            Route::post('/Roles/{role}/permissions/', [AdminRoleController::class,'givePermission'])->name('users.roles.permission');
            Route::delete('/Roles/{role}/permissions/{permission}', [AdminRoleController::class,'removePermission'])
                ->name('users.roles.permission.remove');

            Route::get('/Permissions', [AdminPermissionController::class,'index'])->name('users.permissions.index');
            Route::get('/Permissions/create', [AdminPermissionController::class,'create'])->name('users.permissions.create');
            Route::post('/Permissions/store/{id}', [AdminPermissionController::class,'storeUpdate'])->name('users.permissions.store');
            Route::get('/Permissions/edit/{id}', [AdminPermissionController::class,'edit'])->name('users.permissions.edit');
            Route::post('/Permissions/Update/{id}', [AdminPermissionController::class,'storeUpdate'])->name('users.permissions.update');
            Route::get('/Permissions/delete/{id}', [AdminPermissionController::class,'destroy'])->name('users.permissions.destroy');

            Route::post('/Permissions/{permission}/roles', [AdminPermissionController::class,'assignRole'])->name('users.permission.roles');
            Route::delete('/Permissions/{permission}/roles/{role}', [AdminPermissionController::class,'removeRole'])->name
            ('users.permission.roles.remove');

        });
    });
});

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



