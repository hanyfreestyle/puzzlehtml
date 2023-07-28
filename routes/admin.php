<?php


use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\config\AmenityController;
use App\Http\Controllers\admin\DeveloperController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\UnitController;

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



Route::get('/project/sliderGet',[ProjectController::class,'sliderGet'])->name('project.sliderGet');
Route::get('/project',[ProjectController::class,'index'])->name('project.index');
Route::get('/project/create',[ProjectController::class,'create'])->name('project.create');
Route::post('/project/store/{id}',[ProjectController::class,'storeUpdate'])->name('project.store');
Route::get('/project/edit/{id}',[ProjectController::class,'edit'])->name('project.edit');
Route::post('/project/update/{id}',[ProjectController::class,'storeUpdate'])->name('project.update');
Route::get('/project/destroy/{id}',[ProjectController::class,'destroy'])->name('project.destroy');
Route::post('/project/updateStatus', [ProjectController::class,'updateStatus'])->name('project.updateStatus');
Route::get('/project/emptyPhoto/{id}', [ProjectController::class,'emptyPhoto'])->name('project.emptyPhoto');
Route::get('/project/SoftDelete/',[ProjectController::class,'SoftDeletes'])->name('project.SoftDelete');
Route::get('/project/restore/{id}',[ProjectController::class,'Restore'])->name('project.restore');
Route::get('/project/force/{id}',[ProjectController::class,'ForceDeletes'])->name('project.force');

Route::get('/project/photos/{id}',[ProjectController::class,'ListMorePhoto'])->name('project.More_Photos');
Route::post('/project/saveSort', [ProjectController::class,'sortPhotoSave'])->name('project.sortPhotoSave');
Route::post('/project/AddMore',[ProjectController::class,'AddMorePhotos'])->name('project.More_PhotosAdd');
Route::get('/project/PhotoDel/{id}',[ProjectController::class,'More_PhotosDestroy'])->name('project.More_PhotosDestroy');


Route::get('/project/faqlist/{id}',[QuestionController::class,'FaqList'])->name('project.faq_list');
Route::get('/project/FaqSoftDelete/{id}',[QuestionController::class,'FaqSoftDeletes'])->name('project.faq_SoftDelete');
Route::get('/project/faqrestore/{id}',[QuestionController::class,'FaqRestore'])->name('project.faq_restore');
Route::get('/project/faqforce/{id}',[QuestionController::class,'FaqForceDeletes'])->name('project.faq_force');

Route::get('/project/faq/create/{project_id}',[QuestionController::class,'FaqCreate'])->name('project.faq_create');
Route::get('/project/faq/edit/{id}',[QuestionController::class,'Faqedit'])->name('project.faq_edit');
Route::post('/project/faq/update/{id}',[QuestionController::class,'FaqstoreUpdate'])->name('project.faq_update');
Route::get('/project/faq/destroy/{id}',[QuestionController::class,'Faqdestroy'])->name('project.faq_destroy');





Route::get('/unit',[UnitController::class,'index'])->name('unit.index');
Route::get('/unit/create',[UnitController::class,'create'])->name('unit.create');
Route::post('/unit/store/{id}',[UnitController::class,'storeUpdate'])->name('unit.store');
Route::get('/unit/edit/{id}',[UnitController::class,'edit'])->name('unit.edit');
Route::post('/unit/update/{id}',[UnitController::class,'storeUpdate'])->name('unit.update');
Route::get('/unit/destroy/{id}',[UnitController::class,'destroy'])->name('unit.destroy');
Route::post('/unit/updateStatus', [UnitController::class,'updateStatus'])->name('unit.updateStatus');
Route::get('/unit/emptyPhoto/{id}', [UnitController::class,'emptyPhoto'])->name('unit.emptyPhoto');
Route::get('/unit/SoftDelete/',[UnitController::class,'SoftDeletes'])->name('unit.SoftDelete');
Route::get('/unit/restore/{id}',[UnitController::class,'Restore'])->name('unit.restore');
Route::get('/unit/force/{id}',[UnitController::class,'ForceDeletes'])->name('unit.force');
Route::get('/unit/photos/{id}',[UnitController::class,'ListMorePhoto'])->name('unit.More_Photos');
Route::post('/unit/saveSort', [UnitController::class,'sortPhotoSave'])->name('unit.sortPhotoSave');
Route::post('/unit/AddMore',[UnitController::class,'AddMorePhotos'])->name('unit.More_PhotosAdd');
Route::get('/unit/PhotoDel/{id}',[UnitController::class,'More_PhotosDestroy'])->name('unit.More_PhotosDestroy');

