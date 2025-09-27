<?php

use App\Http\Controllers\Admin\Master\FacilityController;
use App\Http\Controllers\Admin\Master\GalleryController;
use App\Http\Controllers\Admin\Master\PageDetailController; 
use Illuminate\Support\Facades\Route;

// prefix name route = admin.
Route::prefix('/master')->name('master.')->group(function () {

     // ==== page-detail Routes ====
    Route::prefix('/page-detail')->name('page-detail.')->group(function () {
        $localClass = PageDetailController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
     
    // ==== facility Routes ====
    Route::prefix('/facility')->name('facility.')->group(function () {
        $localClass = FacilityController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
     
    // ==== gallery Routes ====
    Route::prefix('/gallery')->name('gallery.')->group(function () {
        $localClass = GalleryController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    });