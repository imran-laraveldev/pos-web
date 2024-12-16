<?php

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

Route::prefix('schools')->group(function() {
    Route::get('/', 'SchoolsController@index')->name('schools.index');
    Route::prefix('students')->group(function() {
//        Route::get('/', 'StudentController@index')->name('schools.students.index');
        Route::get('/', [\Modules\Schools\Http\Controllers\StudentController::class, 'index'])->name('schools.students.listing');
        Route::get('/test', [\Modules\Schools\Http\Controllers\StudentController::class, 'testStudents'])->name('schools.students.test');
        Route::post('/datatable', [\Modules\Schools\Http\Controllers\StudentController::class, 'getDatatableList'])->name('schools.students.datatable');
        Route::post('/create', [\Modules\Schools\Http\Controllers\StudentController::class, 'create'])->name('schools.students.create_modal');
        Route::post('/validate', [\Modules\Schools\Http\Controllers\StudentController::class, 'validate'])->name('schools.students.validate');
        Route::get('/create', [\Modules\Schools\Http\Controllers\StudentController::class, 'create'])->name('schools.students.create');
        Route::post('/store', [\Modules\Schools\Http\Controllers\StudentController::class, 'store'])->name('schools.students.store');
        Route::get('/{id}/view', [\Modules\Schools\Http\Controllers\StudentController::class, 'show'])->name('schools.students.show');
        Route::get('/{id}/edit', [\Modules\Schools\Http\Controllers\StudentController::class, 'edit'])->name('schools.students.edit');
        Route::put('/{id}/update', [\Modules\Schools\Http\Controllers\StudentController::class, 'update'])->name('schools.students.update');
    });
});
