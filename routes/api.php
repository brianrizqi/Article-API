<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;

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

Route::get('/', function () {
    return 'Article API';
});
Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {
    // category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{id}/edit', [CategoryController::class, 'update']);
    Route::get('/category/{slug}', [CategoryController::class, 'show']);
    Route::delete('/category/{slug}', [CategoryController::class, 'destroy']);

    // article
    Route::get('/article', [ArticleController::class, 'index']);
    Route::post('/article', [ArticleController::class, 'store']);
    Route::put('/article/{slug}/edit', [ArticleController::class, 'update']);
    Route::get('/article/{slug}', [ArticleController::class, 'show']);
    Route::delete('/article/{slug}', [ArticleController::class, 'destroy']);
});
