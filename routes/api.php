<?php

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

Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
Route::get('users', [\App\Http\Controllers\Api\OrderController::class, 'getRecords']);
Route::get('students', [\App\Http\Controllers\Api\OrderController::class, 'getStudents']);
Route::put('students/{id}', [\App\Http\Controllers\Api\OrderController::class, 'updateStudent']);
Route::delete('students/{id}', [\App\Http\Controllers\Api\OrderController::class, 'deleteStudent']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'milestones'], function () {
    Route::post('/', [\App\Http\Controllers\Api\OrderController::class, 'index']);
    Route::post('create', [\App\Http\Controllers\Api\OrderController::class, 'store']);
    Route::get('{id}', [\App\Http\Controllers\Api\OrderController::class, 'show']);
    Route::patch('{id}', [\App\Http\Controllers\Api\OrderController::class, 'update']);
    Route::delete('{id}', [\App\Http\Controllers\Api\OrderController::class, 'destroy']);
});
