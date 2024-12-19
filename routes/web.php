<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/signout', [App\Http\Controllers\HomeController::class, 'logout'])->name('signout');
Route::post('getDivision', [\App\Http\Controllers\UtilityController::class,'getDivisionsByProvinceId']);
Route::post('getDistrict', [\App\Http\Controllers\UtilityController::class,'getDistrictByDivisionID']);
Route::post('getTehsil', '\App\Http\Controllers\UtilityController@getTehsilByDistrictID');
Route::post('getFundCenters', [\App\Http\Controllers\UtilityController::class,'getFundCentersByGrantId']);

Route::group(['prefix'=>'acl', 'as' => 'acl.'], function() {
    Route::get('/list/{department_id?}', [App\Http\Controllers\Acl\UserController::class, 'listing'])
        ->name('user.listing');
    Route::get('/permission/list', [App\Http\Controllers\Acl\PermissionController::class, 'listing'])
        ->name('permission.listing');

    Route::get('/create', [App\Http\Controllers\Acl\UserController::class, 'create'])->name('user.create');
    Route::post('/validate', [App\Http\Controllers\Acl\UserController::class, 'validate'])->name('user.validate');
    Route::post('/store', [App\Http\Controllers\Acl\UserController::class, 'store'])->name('user.store');
    Route::get('/view/{id}', [App\Http\Controllers\Acl\UserController::class, 'show'])->name('user.show');

    Route::post('/role/list-datatable', [App\Http\Controllers\Acl\RoleController::class, 'getAjaxListData'])->name('role.datatable');
    Route::get('/role/create', [App\Http\Controllers\Acl\RoleController::class, 'create'])->name('role.create');
    Route::post('/role/validate', [App\Http\Controllers\Acl\RoleController::class, 'validate'])->name('role.validate');
    Route::post('/role/store', [App\Http\Controllers\Acl\RoleController::class, 'store'])->name('role.store');
    Route::get('/role/view/{id}', [App\Http\Controllers\Acl\RoleController::class, 'show'])->name('role.show');
    Route::delete('/role/destroy/{id}', [App\Http\Controllers\Acl\RoleController::class, 'destroy'])->name('role.del');
    Route::get('/role/edit/{id}', [App\Http\Controllers\Acl\RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update/{id}', [App\Http\Controllers\Acl\RoleController::class, 'update'])->name('role.update');
});
Route::get('/roles-list', [App\Http\Controllers\Acl\RoleController::class, 'listing'])->name('roles');
//Route::get('/roles-list', [App\Http\Controllers\Acl\RoleController::class, 'listing'])->name('roles');
Route::fallback(function () {
    return redirect()->route('home');
});
