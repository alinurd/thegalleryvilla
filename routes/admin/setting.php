<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Setting\AppSettingController;
//prefix name = admin.
Route::prefix('setting')->name('setting.')->group(function() {
    Route::get('/app-setting', [AppSettingController::class, 'index'])->name('appsetting.index');
    Route::post('/app-setting', [AppSettingController::class, 'saveSetting'])->name('appsetting.save');
});
