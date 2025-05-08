<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\InfoUserController;

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
Route::get("/datasites", [SiteController::class, 'getDataSites']);
Route::get('/datasites/{id}', [SiteController::class, 'getDataSiteById']);
Route::get("/tiket/datasites", [TiketController::class, 'getDataSites']);
Route::get('/tiket/datasites/{id}', [TiketController::class, 'getDataSiteById']);

Route::get('/user/{id}', [InfoUserController::class, 'getUser']);
