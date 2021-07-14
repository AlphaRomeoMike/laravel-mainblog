<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('post', [PostController::class, 'index'])->name('post');
Route::get('post/create', [PostController::class, 'create'])->name('create')->middleware(['auth']);
Route::post('post/create', [PostController::class, 'store'])->name('create')->middleware(['auth']);
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('edit')->middleware(['auth']);
Route::post('post/edit/{id}', [PostController::class, 'update'])->name('edit/{id}')->middleware(['auth']);
Route::post('post/delete/{id}', [PostController::class, 'destroy'])->name('delete/{id}')->middleware(['auth']);
Route::get('post/user/{id}', [PostController::class, 'UserPosts'])->name('user/{id}')->middleware(['auth']);
Route::get('post/{id}', [PostController::class, 'find'])->name('post/{id}');
