<?php 
use App\Http\Controllers\Admin\Master\CategoryController; 
use Illuminate\Support\Facades\Route;

// prefix name route = admin.
Route::prefix('/master')->name('master.')->group(function () {

     // ==== Category Routes ====
    Route::prefix('/category')->name('category.')->group(function () {
        $localClass = CategoryController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    });