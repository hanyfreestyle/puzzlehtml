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


       Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('admin.config.web');
       Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('admin.webConfigUpdate');


/*
        Route::get('/', [AdminController::class, 'index'])->name('admin.Dashboard');

        Route::get('/Page1', [AdminController::class, 'blank'])->name('page1');
        Route::get('/Page2', [AdminController::class, 'blank'])->name('page2');

        Route::get('/Config/photoSize', [AdminController::class, 'blank'])->name('config.photoSize');
        Route::get('/Config/defPhoto', [AdminController::class, 'blank'])->name('config.defPhoto');

*/

        Route::get('/metaTags', [MetaTagController::class,'index'])->name('meta.index');
        Route::get('/metaTags/create', [MetaTagController::class,'create'])->name('meta.create');
        Route::post('/metaTags/store', [MetaTagController::class,'store'])->name('meta.store');
        Route::get('/metaTags/edit/{id}', [MetaTagController::class,'edit'])->name('meta.edit');
        Route::post('/metaTags/Update', [MetaTagController::class,'update'])->name('meta.update');
        Route::get('/metaTags/delete/{id}', [MetaTagController::class,'delete'])->name('meta.delete');

        Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
        Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
        Route::post('/amenity/store',[AmenityController::class,'storeUpdate'])->name('amenity.store');
        Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
        Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
        Route::delete('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');
       // Route::resource('/amenity',AmenityController::class);
    });
});
