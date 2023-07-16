<?php
use App\Http\Controllers\admin\roles\PermissionController;
use App\Http\Controllers\admin\roles\RoleController;
use App\Http\Controllers\admin\roles\UserController;

Route::get('/Users', [UserController::class,'index'])->name('users.users.index');
Route::get('/Users/create', [UserController::class,'create'])->name('users.users.create');
Route::post('/Users/store/{id}', [UserController::class,'storeUpdate'])->name('users.users.store');
Route::get('/Users/edit/{id}', [UserController::class,'edit'])->name('users.users.edit');
Route::post('/Users/Update/{id}', [UserController::class,'storeUpdate'])->name('users.users.update');
Route::get('/Users/delete/{id}', [UserController::class,'destroy'])->name('users.users.destroy');
Route::post('/Users/updateStatus', [UserController::class,'updateStatus'])->name('users.users.updateStatus');
Route::get('/Users/emptyPhoto/{id}', [UserController::class,'emptyPhoto'])->name('users.users.emptyPhoto');

Route::get('/Roles', [RoleController::class,'index'])->name('users.roles.index');
Route::get('/Roles/create', [RoleController::class,'create'])->name('users.roles.create');
Route::get('/Roles/edit/{id}', [RoleController::class,'edit'])->name('users.roles.edit');
Route::get('/Roles/delete/{id}', [RoleController::class,'destroy'])->name('users.roles.destroy');
Route::post('/Roles/Update/{id}', [RoleController::class,'storeUpdate'])->name('users.roles.update');
Route::get('/Roles/editRoleToPermission/{id}', [RoleController::class,'editRoleToPermission'])->name('users.roles.editRoleToPermission');
Route::post('/Roles/givePermission', [RoleController::class,'givePermission'])->name('users.roles.givePermission');

Route::get('/Permissions', [PermissionController::class,'index'])->name('users.permissions.index');
Route::get('/Permissions/create', [PermissionController::class,'create'])->name('users.permissions.create');
Route::get('/Permissions/edit/{id}', [PermissionController::class,'edit'])->name('users.permissions.edit');
Route::get('/Permissions/delete/{id}', [PermissionController::class,'destroy'])->name('users.permissions.destroy');
Route::post('/Permissions/Update/{id}', [PermissionController::class,'storeUpdate'])->name('users.permissions.update');
