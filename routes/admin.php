<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;

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


Auth::routes();

Route::prefix('admin')->group(function () {

    Route::get('login', [AuthController::class, 'adminLogin'])->middleware('guest:admin');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::resource('/admins', AdminController::class);
        Route::resource('/admin_posts', PostController::class);
        Route::resource('/admin_reports', ReportController::class);
        Route::post('admin_logout', [AuthController::class, 'logout'])->name('admin.logout');
    });


});
