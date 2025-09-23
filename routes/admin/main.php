<?php
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('webmin')->name('admin.')->group(function() {
    Route::get('/',[AuthController::class, 'login']); //aliases
    Route::prefix('login')->name('login.')->group(function() {
        // LOGIN
        Route::get('/',[AuthController::class,'login'])->name('view');
        Route::post('/',[AuthController::class,'postLogin'])->name('post');
    });


    Route::middleware('admin')->group(function() {
        Route::get('/logout',[AuthController::class,'postLogout'])->name('logout.post');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // include other files
        require_once __DIR__.'/master.php';
        require_once __DIR__.'/setting.php';
        require_once __DIR__.'/userman.php'; 
    });

});

