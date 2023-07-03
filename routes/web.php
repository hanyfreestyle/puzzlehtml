<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\config\DefPhotoController;
use App\Http\Controllers\admin\config\MetaTagController;
use App\Http\Controllers\admin\config\SettingsController;
use App\Http\Controllers\admin\config\UploadFilterController;
use App\Http\Controllers\admin\config\UploadFilterSizeController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
  #  Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::group(['prefix'=>'admin'],function(){

        Route::get('/Home', [AdminController::class, 'index'])->name('admin.Dashboard');


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

    });
});
