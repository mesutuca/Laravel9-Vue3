<?php

use App\Http\Controllers\CategoriController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInformationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\SliderController;
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

Route::put('/sliders/updateAll', [SliderController::class, 'updateAll']);
Route::put('/sliders/deleteAll', [SliderController::class, 'deleteAll']);
Route::get('/sliders/{id}', [SliderController::class, 'index']);
Route::put('/sliders/{id}', [SliderController::class, 'update']);
Route::delete('/sliders/{id}', [SliderController::class, 'destroy']);
Route::get('/sliders/{id}/detail', [SliderController::class, 'show']);
Route::post('/sliders', [SliderController::class, 'store']);

Route::apiResources([
    '/categories' => CategoriController::class,
    '/posts' => PostController::class,
    '/postimage' => PostImageController::class,
    '/contactFoo' => ContactController::class,
    '/contacts' => ContactInformationController::class,
]);


//Route::controller(PostController::class)->group(function () {
//    Route::resource('/posts', PostController::class);
//});
//Route::controller(PostImageController::class)->group(function () {
//    Route::resource('/postimage', PostImageController::class);

//    Route::prefix('/postimage')->group(function () {
//        Route::get('', 'index');
//        Route::post('', 'store');
//        Route::delete('/{id}', 'destroy');
//        Route::put('/{id}', 'update');
//    });
//});

Route::any('{path}', function () {
    return view('app');
})->where('path', '.*');
