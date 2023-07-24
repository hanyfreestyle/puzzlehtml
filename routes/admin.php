<?php


use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\DeveloperController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\PostController;

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



Route::get('/developer/sliderGet',[DeveloperController::class,'sliderGet'])->name('location.sliderGet');
Route::get('/developer',[DeveloperController::class,'index'])->name('developer.index');
Route::get('/developer/create',[DeveloperController::class,'create'])->name('developer.create');
Route::post('/developer/store/{id}',[DeveloperController::class,'storeUpdate'])->name('developer.store');
Route::get('/developer/edit/{id}',[DeveloperController::class,'edit'])->name('developer.edit');
Route::post('/developer/update/{id}',[DeveloperController::class,'storeUpdate'])->name('developer.update');
Route::get('/developer/destroy/{id}',[DeveloperController::class,'destroy'])->name('developer.destroy');

Route::post('/developer/updateStatus', [DeveloperController::class,'updateStatus'])->name('developer.updateStatus');
Route::get('/developer/emptyPhoto/{id}', [DeveloperController::class,'emptyPhoto'])->name('developer.emptyPhoto');
Route::get('/developer/SoftDelete/',[DeveloperController::class,'SoftDeletes'])->name('developer.SoftDelete');
Route::get('/developer/restore/{id}',[DeveloperController::class,'Restore'])->name('developer.restore');
Route::get('/developer/force/{id}',[DeveloperController::class,'ForceDeletes'])->name('developer.force');

Route::get('/developer/photos/{id}',[DeveloperController::class,'ListMorePhoto'])->name('developer.More_Photos');

Route::post('/developer/saveSort', [DeveloperController::class,'sortPhotoSave'])->name('developer.sortPhotoSave');
Route::post('/developer/AddMore',[DeveloperController::class,'AddMorePhotos'])->name('developer.More_PhotosAdd');

Route::get('/developer/PhotoDel/{id}',[DeveloperController::class,'More_PhotosDestroy'])->name('developer.More_PhotosDestroy');






Route::get('/post/sliderGet',[PostController::class,'sliderGet'])->name('post.sliderGet');
Route::get('/post',[PostController::class,'index'])->name('post.index');
Route::get('/post/create',[PostController::class,'create'])->name('post.create');
Route::post('/post/store/{id}',[PostController::class,'storeUpdate'])->name('post.store');
Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
Route::post('/post/update/{id}',[PostController::class,'storeUpdate'])->name('post.update');
Route::get('/post/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');

Route::post('/post/updateStatus', [PostController::class,'updateStatus'])->name('post.updateStatus');
Route::get('/post/emptyPhoto/{id}', [PostController::class,'emptyPhoto'])->name('post.emptyPhoto');
Route::get('/post/SoftDelete/',[PostController::class,'SoftDeletes'])->name('post.SoftDelete');
Route::get('/post/restore/{id}',[PostController::class,'Restore'])->name('post.restore');
Route::get('/post/force/{id}',[PostController::class,'ForceDeletes'])->name('post.force');

Route::get('/post/photos/{id}',[PostController::class,'ListMorePhoto'])->name('post.More_Photos');

Route::post('/post/saveSort', [PostController::class,'sortPhotoSave'])->name('post.sortPhotoSave');
Route::post('/post/AddMore',[PostController::class,'AddMorePhotos'])->name('post.More_PhotosAdd');

Route::get('/post/PhotoDel/{id}',[PostController::class,'More_PhotosDestroy'])->name('post.More_PhotosDestroy');
