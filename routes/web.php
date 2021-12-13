<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); //get posts list
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); //page to create new post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); //store the new post

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); //ask controller to store new comment

//below should be absolute last so as not to hijack longer links
// routes must always come BEFORE variables. e.g., posts/create before posts/{id}
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); //show particular post details
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); //edit a post
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); //store updated post details
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); //delete the post
