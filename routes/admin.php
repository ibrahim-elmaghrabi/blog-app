<?php

use App\Models\PostReport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\PostReportController;

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


Route::prefix('admin')->group(function () {

    Route::get('login', [AuthController::class, 'adminLogin']);
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');

    Route::group(['middleware' => ['auth:admin']], function () {
    });

    Route::get('/', [HomeController::class, 'index'])->name('admin.index');
    Route::resource('/admins', AdminController::class);
    Route::resource('/users', UserController::class);
    Route::get('users/{user}/{status}', [UserController::class, 'updateStatus'])->name('users.status.update');
    Route::resource('/admin_posts', PostController::class);
    Route::resource('/admin_reports', ReportController::class);
    Route::get('posts/{post}/{status}', [PostController::class, 'updateStatus'])->name('posts.status.update');
    Route::get('/admin_posts/{post}/comments', [PostController::class, 'showComments'])->name('admin_comments.show');
    Route::delete('/admin_posts/comments/{comment}', [CommentController::class, 'destroy'])->name('admin_comments.destroy');
    Route::get('/admin_posts/{post}/reports', [PostController::class, 'showReports'])->name('admin_reports.show');
    Route::delete('/admin_posts/reports/{report}', [PostReportController::class, 'destroy'])->name('admin_reports_posts.destroy');

    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

});
