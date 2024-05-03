<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
use App\Http\Controllers\ProfileController;
Route::get('/posts',[PostController::class,'index'])->name('posts.home');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
Route::get("/posts/create",[PostController::class,'create'])->name('post.create');
Route::put('/posts/restore', [PostController::class,'restore'])->name('posts.restore');
Route::get("/posts/{id}", [PostController::class,'show'])->name('post.show');
Route::get('/posts/{id}/edit', [PostController::class,'edit'])->name('post.edit');
Route::put('/posts/{id}', [PostController::class,'update'])->name('post.update');
Route::delete("/posts/{id}/delete", [PostController::class,'destroy'])->name('post.destroy');
Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');
 
Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    //dd($githubUser);
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id
    ], [
        'name' => $githubUser->nickname,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
        'password' => Hash::make($githubUser->token)

    ]);
    Auth::login($user);

    return redirect('/posts');
    // $user->token
});