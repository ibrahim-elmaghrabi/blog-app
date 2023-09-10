<?php

use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/search', [PostController::class, 'search'])->name('search');
Route::get('/sort', [PostController::class, 'sort'])->name('sort');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('posts', PostController::class)->except('index');
    Route::resource('posts.comments', CommentController::class);
    Route::resource('posts.reports', ReportController::class);
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
 });



