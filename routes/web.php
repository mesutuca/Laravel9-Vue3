<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
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
Route::controller(PostController::class)->group(function () {
    Route::prefix('/post')->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
    });
});
Route::controller(PostImageController::class)->group(function () {
    Route::prefix('/postimage')->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::delete('/{id}', 'destroy');
    });
});

Route::any('{path}', function () {
    return view('app');
})->where('path', '.*');
