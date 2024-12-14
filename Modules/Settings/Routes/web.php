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

Route::prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index')->name('settings');
    Route::prefix('budget_types')->group(function() {

        Route::get('/', 'BudgetTypeController@index')->name('budget_types');
        Route::get('/create', 'BudgetTypeController@create')->name('budget_types.create');
        Route::post('/store', 'BudgetTypeController@store')->name('budget_types.store');
        Route::get('/{id}/view', 'BudgetTypeController@show')->name('budget_types.show');
        Route::get('/{id}/edit', 'BudgetTypeController@edit')->name('budget_types.edit');
        Route::put('/{id}/update', 'BudgetTypeController@update')->name('budget_types.update');
        Route::get('/{id}/delete', 'BudgetTypeController@destroy')->name('budget_types.destroy');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [\Modules\Settings\Http\Controllers\ProductController::class, 'index'])->name('products');
        Route::post('/datatable', [\Modules\Settings\Http\Controllers\ProductController::class, 'getDatatableList'])->name('products.datatable');
        Route::post('/create', [\Modules\Settings\Http\Controllers\ProductController::class, 'create'])->name('products.create_modal');
        Route::post('/validate', [\Modules\Settings\Http\Controllers\ProductController::class, 'validate'])->name('products.validate');
        Route::get('/create', [\Modules\Settings\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [\Modules\Settings\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}/view', [\Modules\Settings\Http\Controllers\ProductController::class, 'show'])->name('products.show');
        Route::get('/{id}/edit', [\Modules\Settings\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{id}/update', [\Modules\Settings\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        // Route::get('/{id}/delete', [\Modules\Settings\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::prefix('dynamic-forms')->group(function () {
        Route::get('/', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'index'])->name('dynamic_forms');
        Route::post('/datatable', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'getDatatableList'])->name('dynamic_forms.datatable');
        Route::post('/create', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'create'])->name('dynamic_forms.create_modal');
        Route::post('/validate', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'validate'])->name('dynamic_forms.validate');
        Route::get('/create', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'create'])->name('dynamic_forms.create');
        Route::post('/store', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'store'])->name('dynamic_forms.store');
        Route::get('/{id}/view', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'show'])->name('dynamic_forms.show');
        Route::get('/{id}/edit', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'edit'])->name('dynamic_forms.edit');
        Route::put('/{id}/update', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'update'])->name('dynamic_forms.update');
        Route::post('/{id}/migrate', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'makeMigrationCommand'])->name('dynamic_forms.migrate');

        Route::get('/listing/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('dynamic_forms.listing');
        Route::post('/form/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'createForm'])->name('dynamic_forms.create-form');
        Route::post('/store-form/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'storeForm'])->name('dynamic_forms.store-form');

        Route::post('/show-form/{id}/{recordId}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'showForm'])->name('dynamic_forms.show-form');
        Route::post('/edit-form/{id}/{recordId}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'editForm'])->name('dynamic_forms.edit-form');
        Route::post('/update-form/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'updateForm'])->name('dynamic_forms.update-form');
        Route::get('/destroy-form-entry/{id}/{recordId}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'deleteFormEntry'])->name('dynamic_forms.destroy-entry');
    });

    Route::get('/classes/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('classes');
    Route::get('/tutions/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('tutions');
    Route::get('/districts/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('districts');
    Route::get('/provinces/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('provinces');
    Route::get('/tehsils/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('tehsils');
    Route::get('/students/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('students');
    Route::get('/divisions/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('divisions');
    Route::get('/employee/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('employee');
    Route::get('/users/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('users');
    Route::get('/departments/{id}', [\Modules\Settings\Http\Controllers\DynamicFormController::class, 'listing'])->name('departments');
    #ROUTE_PLACE_FOR_NEW_ENRTY#




});
