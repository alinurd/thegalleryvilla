<?php
use App\Http\Controllers\Admin\Userman\PermissionController;
use App\Http\Controllers\Admin\Userman\RoleController;
use App\Http\Controllers\Admin\Userman\UserController;
use Illuminate\Support\Facades\Route;
#prefix name = admin.
Route::get('user', [UserController::class,'view'])->name('userman.user.view');
Route::get('browse-user-data', [UserController::class,'browseUserData'])->name('userman.user.browse-user-data');
Route::get('users', [UserController::class,'getAll'])->name('userman.user.all');
Route::post('user', [UserController::class,'store'])->name('userman.user.store');
Route::put('user/{id}', [UserController::class,'update'])->name('userman.user.update');
Route::delete('user/{id}', [UserController::class,'delete'])->name('userman.user.delete');
Route::post('user/change-status', [UserController::class,'changeStatus'])->name('userman.user.change-status');
Route::get('browse-user-data-type/{type}', [UserController::class,'browseUserDataByUserType']) ->name('userman.user.browse-user-data-type');


Route::get('role', [RoleController::class,'view'])->name('userman.role.view');
Route::get('roles', [RoleController::class,'getAll'])->name('userman.role.all');
Route::post('role', [RoleController::class,'store'])->name('userman.role.store');
Route::put('role/{id}', [RoleController::class,'update'])->name('userman.role.update');
Route::delete('role/{id}', [RoleController::class,'delete'])->name('userman.role.delete');

Route::get('permission', [PermissionController::class,'view'])->name('userman.permission.view');
Route::get('permissions', [PermissionController::class,'getAll'])->name('userman.permission.all');
Route::post('permission', [PermissionController::class,'store'])->name('userman.permission.store');
Route::put('permission/{id}', [PermissionController::class,'update'])->name('userman.permission.update');
Route::delete('permission/{id}', [PermissionController::class,'delete'])->name('userman.permission.delete');
