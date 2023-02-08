<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;


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

Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware("auth");


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{postId}',[PostController::class,'destroy'])->name("posts.destroy");
Route::get('/posts\restore' , [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/{postId}/edit', [PostController::class, "edit"])->name('posts.edit');
Route::put('/posts/{postId}' , [PostController::class, 'update'])->name('post.update');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});