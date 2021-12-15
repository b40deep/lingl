<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlertController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Boyd added
Route::post('/alerts',[AlertController::class, 'apiIndex'])->name('api.alerts.index');
// Route::post('/alerts',[AlertController::class, 'apiStore'])->name('api.alerts.store');
Route::get('/comments/{post}',[CommentController::class, 'apiIndex'])->name('api.comments.index');
Route::post('/comments',[CommentController::class, 'apiDestroy'])->name('api.comments.del');
Route::post('/comments/{post}',[CommentController::class, 'apiStore'])->name('api.comments.store');
