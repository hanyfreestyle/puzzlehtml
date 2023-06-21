<?php

use App\Http\Controllers\admin\AdminController;
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

Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::get('/Home', [AdminController::class, 'index'])->name('Dashboard');
    Route::get('/Page1', [AdminController::class, 'blank'])->name('page1');
    Route::get('/Page2', [AdminController::class, 'blank'])->name('page2');

    Route::get('/Home2', [AdminController::class, 'index'])->name('Dashboard2');
    Route::get('/Page3', [AdminController::class, 'blank'])->name('page3');
    Route::get('/Page4', [AdminController::class, 'blank'])->name('page4');
});
