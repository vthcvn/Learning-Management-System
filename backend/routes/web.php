<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [UserController::class, 'index']);

Route::get('/test', [PostController::class, 'test']);
Route::post('/test', [PostController::class, 'test1']);

Route::get('posting', [ForumController::class, 'index']);
Route::post('store_post', [ForumController::class, 'sendData']);
Route::get('/upload', [CourseController::class, 'test']);
Route::get('/upload/update', [CourseController::class, 'test1']);
Route::get('/submit/delete', [CourseController::class, 'deleteSubmission']);
