<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'prefix' => 'auth'

], function ($router) {

    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('/me', [App\Http\Controllers\AuthController::class, 'me']);
});

Route::get('/file/{path}', [App\Http\Controllers\Image\ImageFileController::class, '__invoke'])->where('path', '.*')->name('image.file');

Route::group(['prefix' => 'images', 'namespace' => 'API_Image', 'middleware' => 'auth:api'], function () {
    Route::get('/list', [App\Http\Controllers\API_Image\ImageAllController::class, '__invoke']);
    Route::post('/upload', [App\Http\Controllers\API_Image\ImageUploadController::class, '__invoke']);
    Route::delete('/delete', [App\Http\Controllers\API_Image\ImageDeleteController::class, '__invoke']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});