<?php
use App\Http\Controllers\Frontend\LanddingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->name('guest.')->group(function() {
        $localClass = LanddingController::class;
        Route::get('/', [$localClass, 'index'])->name('index'); 
});

