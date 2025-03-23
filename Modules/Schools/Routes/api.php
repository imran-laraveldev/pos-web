<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/schools', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'schools', 'as' => 'schools.'], function () {
    Route::get('users', [\Modules\Schools\Http\Controllers\StudentController::class, 'getRecords']);
    Route::get('students', [\Modules\Schools\Http\Controllers\StudentController::class, 'getStudents']);
    Route::post('students', [\Modules\Schools\Http\Controllers\StudentController::class, 'storeStudent']);
    Route::put('students/{id}', [\Modules\Schools\Http\Controllers\StudentController::class, 'updateStudent']);
    Route::delete('students/{id}', [\Modules\Schools\Http\Controllers\StudentController::class, 'deleteStudent']);
});
