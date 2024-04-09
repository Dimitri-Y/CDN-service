<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\CustomLoginController;
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

Auth::routes(['verify' => false]);
Route::post('/login', [CustomLoginController::class, 'login'])->name('login');

Route::get('/file/{path}', [App\Http\Controllers\Image\ImageFileController::class, '__invoke'])->where('path', '.*')->name('image.file');

Route::group(['prefix' => 'home'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['namespace' => 'Image'], function () {
        Route::get('/images/list', [App\Http\Controllers\Image\ImageAllController::class, '__invoke'])->name('image.all');
        Route::get('/images/upload', [App\Http\Controllers\Image\ImageUploadViewController::class, '__invoke'])->name('image.upload.view');
        Route::post('/images/upload', [App\Http\Controllers\Image\ImageUploadController::class, '__invoke'])->name('image.upload');
        Route::delete('/images/delete', [App\Http\Controllers\Image\ImageDeleteController::class, '__invoke'])->name('image.delete');
    });
});