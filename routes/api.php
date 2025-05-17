<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/user', [UserController::class, 'index']);
Route::post('/user/register', [UserController::class, 'register']);
Route::get('/user/show/{id}', [UserController::class, 'show']);
Route::post('/user/login', [UserController::class, 'login']);
Route::put('/user/edit/{id}', [UserController::class, 'edit']);
//Route::get('/book', [BookController::class, 'index']);
//Route::post('/book/create', [BookController::class, 'create']);
//Route::put('/book/edit/{id}', [BookController::class, 'edit']);
//Route::delete('/book/delete/{id}', [BookController::class, 'delete']);
//Route::get('/books/type/{type}', [BookController::class, 'getBooksByType']);
// Route::get('/comment', [CommentController::class, 'index']);
// Route::get('/comment/create', [CommentController::class, 'create']);
//Route::get('/rating', [RatingController::class, 'index']);
//Route::post('/rating/create', [RatingController::class, 'create']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/type/{type}', [BookController::class, 'getBooksByType']);
Route::post('/books/create', [BookController::class, 'create']);
Route::put('/books//edit/{id}', [BookController::class, 'edit']);
Route::delete('/books//delete{id}', [BookController::class, 'delete']);

Route::get('/rating', [RatingController::class, 'index']);
Route::post('/rating/create', [RatingController::class, 'create']); // POST لإضافة تقييم
// إذا أضفت edit، أضف المسار:
Route::put('/rating/{id}', [RatingController::class, 'edit']);
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments/create/{id}', [CommentController::class, 'create']); // POST لإضافة تعليق
Route::put('/comments/edit/{id}', [CommentController::class, 'edit']);    // PUT لتعديل تعليق
