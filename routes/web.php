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
        Route::get('/Config/Env', [AdminController::class, 'blank'])->name('config.env');
        Route::get('/Config/Photo', [AdminController::class, 'blank'])->name('config.photo');


        Route::get('/Config/Env2', [AdminController::class, 'blank'])->name('config.env2');
        Route::get('/Config/Photo2', [AdminController::class, 'blank'])->name('config.photo2');
        Route::get('/Config/Web2', [AdminController::class, 'blank'])->name('config.web2');

    });
});
