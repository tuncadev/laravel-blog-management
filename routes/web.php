<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Auth::routes();

Route::get('/', [PostController::class, 'homepage'])->name('homepage');

Route::resource('categories', CategoryController::class);

Route::resource('posts', PostController::class);

Route::resource('posts.comments', CommentController::class)->shallow();

Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
