<?php

use App\Http\Controllers\admin\config\LangFileController;
use App\Http\Controllers\admin\config\SettingsController;

Route::get('/adminlang',[LangFileController::class,'index'])->name('adminlang.index');
Route::post('/adminlang/updateFile',[LangFileController::class,'updateFile'])->name('adminlang.updateFile');

Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('config.web.index');
Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('admin.webConfigUpdate');

