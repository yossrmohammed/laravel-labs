<?php

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

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
Route::get('/posts',[PostController::class,'index'])->name('posts.home');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
Route::get("/posts/create",[PostController::class,'create'])->name('post.create');
Route::put('/posts/restore', [PostController::class,'restore'])->name('posts.restore');
Route::get("/posts/{id}", [PostController::class,'show'])->name('post.show');
Route::get('/posts/{id}/edit', [PostController::class,'edit'])->name('post.edit');
Route::put('/posts/{id}', [PostController::class,'update'])->name('post.update');
Route::delete("/posts/{id}/delete", [PostController::class,'destroy'])->name('post.destroy');
Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
