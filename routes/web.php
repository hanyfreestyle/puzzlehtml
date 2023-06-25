<?php

use App\Http\Controllers\admin\AdminController;
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
    Route::group(['prefix'=>'admin','as'=>'admin.'],function(){

        Route::get('/', [AdminController::class, 'index'])->name('Dashboard');
        Route::get('/Home', [AdminController::class, 'index'])->name('Dashboard');
        Route::get('/Page1', [AdminController::class, 'blank'])->name('page1');
        Route::get('/Page2', [AdminController::class, 'blank'])->name('page2');

        Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('config.web');
        Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('webConfigUpdate');

        Route::get('/Config/photoSize', [AdminController::class, 'blank'])->name('config.photoSize');
        Route::get('/Config/defPhoto', [AdminController::class, 'blank'])->name('config.defPhoto');
        Route::get('/Config/metaTags', [AdminController::class, 'blank'])->name('config.metaTags');

/*
 *                 ['text'=> 'admin.menu.setting_web','url'=> 'admin.config.web'],
                ['text'=> 'admin.menu.setting_photo','url'=> 'admin.'],
                ['text'=> 'admin.menu.setting_def_photo','url'=> 'admin.'],
                ['text'=> 'admin.menu.setting_meta_tags','url'=> 'admin.config.'],
 */


    });
});
