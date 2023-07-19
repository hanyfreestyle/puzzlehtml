<?php


use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\LocationController;

Route::get('/amenity',[AmenityController::class,'index'])->name('amenity.index');
Route::get('/amenity/create',[AmenityController::class,'create'])->name('amenity.create');
Route::post('/amenity/store/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.store');
Route::get('/amenity/edit/{id}',[AmenityController::class,'edit'])->name('amenity.edit');
Route::post('/amenity/update/{id}',[AmenityController::class,'storeUpdate'])->name('amenity.update');
Route::delete('/amenity/destroy/{id}',[AmenityController::class,'destroy'])->name('amenity.destroy');
Route::get('/amenity/emptyPhoto/{id}', [AmenityController::class,'emptyPhoto'])->name('amenity.emptyPhoto');

Route::get('/Category',[CategoryController::class,'index'])->name('category.index');
Route::get('/Category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/Category/store/{id}',[CategoryController::class,'storeUpdate'])->name('category.store');
Route::get('/Category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/Category/update/{id}',[CategoryController::class,'storeUpdate'])->name('category.update');
Route::get('/Category/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');

Route::post('/Category/updateStatus', [CategoryController::class,'updateStatus'])->name('category.updateStatus');
Route::get('/Category/emptyPhoto/{id}', [CategoryController::class,'emptyPhoto'])->name('category.emptyPhoto');
Route::get('/Category/SoftDelete/',[CategoryController::class,'SoftDeletes'])->name('category.SoftDelete');
Route::get('/Category/restore/{id}',[CategoryController::class,'Restore'])->name('category.restore');
Route::get('/Category/force/{id}',[CategoryController::class,'ForceDeletes'])->name('category.force');


Route::get('/location',[LocationController::class,'index'])->name('location.index');
Route::get('/location/create',[LocationController::class,'create'])->name('location.create');
Route::post('/location/store/{id}',[LocationController::class,'storeUpdate'])->name('location.store');
Route::get('/location/edit/{id}',[LocationController::class,'edit'])->name('location.edit');
Route::post('/location/update/{id}',[LocationController::class,'storeUpdate'])->name('location.update');
Route::get('/location/destroy/{id}',[LocationController::class,'destroy'])->name('location.destroy');

Route::post('/location/updateStatus', [LocationController::class,'updateStatus'])->name('location.updateStatus');
Route::get('/location/emptyPhoto/{id}', [LocationController::class,'emptyPhoto'])->name('location.emptyPhoto');
Route::get('/location/SoftDelete/',[LocationController::class,'SoftDeletes'])->name('location.SoftDelete');
Route::get('/location/restore/{id}',[LocationController::class,'Restore'])->name('location.restore');
Route::get('/location/force/{id}',[LocationController::class,'ForceDeletes'])->name('location.force');
