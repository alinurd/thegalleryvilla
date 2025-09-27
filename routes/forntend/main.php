<?php 
use App\Http\Controllers\Frontend\LanddingController;
use Illuminate\Support\Facades\Route;

Route::name('guest.')->group(function() {
    $localClass = LanddingController::class;
    Route::get('/', [$localClass, 'index'])->name('home'); 
    Route::get('/facility', [$localClass, 'facility'])->name('facility'); 
    Route::get('/about', [$localClass, 'about'])->name('about'); 
    Route::get('/gallery', [$localClass, 'gallery'])->name('gallery'); 
    Route::get('/booking', [$localClass, 'booking'])->name('booking'); 
    Route::get('/contact', [$localClass, 'contact'])->name('contact'); 
    Route::post('/contact/send', [$localClass, 'sendContact'])->name('contact.send'); 
});
