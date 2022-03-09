<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagePostController;
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


Route::get('/', [ImagePostController::class, 'index']);
Route::get('/user/{id}', [ImagePostController::class, 'userDetail']);
Route::get('/image/{id}', [ImagePostController::class, 'imageDetail']);
Route::middleware(['auth:sanctum', 'verified'])->get('/postImage/',
                            [ImagePostController::class, 'postImageIndex']);
Route::middleware(['auth:sanctum', 'verified'])->post('/postImage/',
                            [ImagePostController::class, 'postImage']);
Route::middleware(['auth:sanctum', 'verified'])->get('/postMovie/',
                            [ImagePostController::class, 'postMovieIndex']);
Route::middleware(['auth:sanctum', 'verified'])->post('/postMovie/',
                            [ImagePostController::class, 'postMovie']);
Route::middleware(['auth:sanctum', 'verified'])->get('/uploadImage/',
                            [ImagePostController::class, 'uploadImageIndex']);
Route::middleware(['auth:sanctum', 'verified'])->post('/uploadImage/',
                            [ImagePostController::class, 'uploadImage']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
