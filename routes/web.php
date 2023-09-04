<?php

use App\Http\Controllers\Web\CommentController;
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

Route::group(['middleware' => ['auth']], function() {
    Route::resource('posts', PostController::class)->except('index');
    Route::resource('posts/{post}/comments', CommentController::class);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 });



