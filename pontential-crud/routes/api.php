<?php

use App\Http\Controllers\DesenvolvedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->group(function () {
    Route::delete('developers/{id}', [DesenvolvedorController::class, 'destroy']);
    Route::get('developers/{id}', [DesenvolvedorController::class, 'show']);
    Route::put('developers/{id}', [DesenvolvedorController::class, 'update']);
    Route::resource('developers', DesenvolvedorController::class);
});
