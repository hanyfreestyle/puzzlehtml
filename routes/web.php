<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AmenityController;
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


        Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
        Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
        Route::post('/amenity/store/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.store');
        Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
        Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
        Route::delete('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');

    });
});
