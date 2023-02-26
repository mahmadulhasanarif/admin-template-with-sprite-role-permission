<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user','middleware' => ['auth:web'], 'as'=>'user.'], function () {

    // Dashboard Route
    Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');

    // profile
    Route::get('profile/edit', [UserProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password/update', [UserProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('status/update/{user}', [UserProfileController::class, 'status'])->name('profile.status');

});

require __DIR__.'/auth.php';


// Admin Route Start

Route::group(['prefix' => 'admin','middleware' => ['auth:admin'], 'as'=>'admin.'], function(){
    // profile Route
    Route::get('profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('status/update/{admin}', [ProfileController::class, 'status'])->name('profile.status');

    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

     // Admin and User Route
     Route::get('user/index', [AdminController::class, 'index'])->name('user.index');
     Route::get('user/create', [AdminController::class, 'create'])->name('user.create');
     Route::post('user/store', [AdminController::class, 'store'])->name('user.store');
     Route::get('user/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
     Route::post('user/update/{id}', [AdminController::class, 'update'])->name('user.update');
     Route::post('user/password/{id}', [AdminController::class, 'updatePassword'])->name('user.password.update');
     Route::get('user/delete/{id}', [AdminController::class, 'delete'])->name('user.delete');

     
    // Role Permission route
    Route::get('role/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
});

require __DIR__.'/adminAuth.php';

