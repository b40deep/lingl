<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

//below should be absolute last
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show'); //should come last not to hijack longer links
