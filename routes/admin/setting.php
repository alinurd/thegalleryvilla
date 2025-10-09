<?php
use App\Http\Controllers\Admin\Setting\AppSettingController;
use App\Http\Controllers\Admin\Setting\EmailSettingController;
use Illuminate\Support\Facades\Route;
//prefix name = admin.
Route::prefix('setting')->name('setting.')->group(function() {
    Route::get('/app-setting', [AppSettingController::class, 'index'])->name('appsetting.index');
    Route::post('/app-setting', [AppSettingController::class, 'saveSetting'])->name('appsetting.save');

    Route::get('/email-setting', [EmailSettingController::class, 'index'])->name('emailsetting.index');
    Route::post('/email-setting', [EmailSettingController::class, 'saveSetting'])->name('emailsetting.save');
});
