<?php

use App\Http\Controllers\admin\AdminController;
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

#Route::get('/DashBord', [AdminController::class, 'index'])->name('home');

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
  #  Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::group(['prefix'=>'admin'],function(){

        Route::get('/', [AdminController::class, 'index'])->name('admin.Dashboard');
        Route::get('/Home', [AdminController::class, 'index'])->name('admin.Dashboard');
        Route::get('/Page1', [AdminController::class, 'blank'])->name('page1');
        Route::get('/Page2', [AdminController::class, 'blank'])->name('page2');

        Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('admin.config.web');
        Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('admin.webConfigUpdate');

        Route::get('/Config/photoSize', [AdminController::class, 'blank'])->name('config.photoSize');
        Route::get('/Config/defPhoto', [AdminController::class, 'blank'])->name('config.defPhoto');




        Route::get('/MetaTags', [MetaTagController::class,'index'])->name('Meta.index');
        Route::get('/MetaTags/Create', [MetaTagController::class,'create'])->name('Meta.Create');
        Route::post('/MetaTags/store', [MetaTagController::class,'store'])->name('Meta.store');

        Route::get('/MetaTags/Edit/{id}', [MetaTagController::class,'edit'])->name('Meta.edit');
        Route::post('/MetaTags/Update', [MetaTagController::class,'update'])->name('Meta.update');

        Route::get('/MetaTags/Delete/{id}', [MetaTagController::class,'delete'])->name('Meta.delete');

    });
});
