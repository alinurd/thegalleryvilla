<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
        return redirect()->route('guest.index');
 });

 
Route::get('/login', function() {
    return redirect()->route('admin.login.view');
});
Route::post('send_email',[MailController::class,'index'])->name('sendMail');



Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'role:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
