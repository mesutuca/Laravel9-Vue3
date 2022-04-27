<?php

use App\Http\Controllers\PostController;
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

Route::prefix('/post')->group(function () {
  Route::get('', [PostController::class, 'show']);
  Route::post('', [PostController::class, 'store']);
});
Route::any('{path}', function () {
  return view('app');
})->where('path', '.*');
