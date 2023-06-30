<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\DefPhotoController;
use App\Http\Controllers\admin\MetaTagController;
use App\Http\Controllers\admin\SettingsController;
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
        Route::post('/defPhotos/store/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.store');
        Route::get('/defPhotos/edit/{id}', [DefPhotoController::class,'edit'])->name('config.defPhoto.edit');
        Route::post('/defPhotos/Update/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.update');
        Route::delete('/defPhotos/delete/{id}', [DefPhotoController::class,'delete'])->name('config.defPhoto.destroy');

        Route::get('/upFilter', [DefPhotoController::class,'index'])->name('config.upFilter.index');
        Route::get('/upFilter/create', [DefPhotoController::class,'create'])->name('config.upFilter.create');
        Route::post('/upFilter/store/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.upFilter.store');
        Route::get('/upFilter/edit/{id}', [DefPhotoController::class,'edit'])->name('config.upFilter.edit');
        Route::post('/upFilter/Update/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.upFilter.update');
        Route::delete('/upFilter/delete/{id}', [DefPhotoController::class,'delete'])->name('config.upFilter.destroy');


        Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
        Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
        Route::post('/amenity/store/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.store');
        Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
        Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
        Route::delete('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');

    });
});
