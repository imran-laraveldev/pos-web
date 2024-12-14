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


Route::prefix('order')->group(function() {
    Route::get('/', 'ReportsController@edit')->name('order');
    Route::get('/{id}/show', 'ReportsController@show')->name('order.show');
});

Route::prefix('reports')->group(function() {
    Route::get('/', 'ReportsController@index')->name('reports');
    Route::get('/sales', 'ReportsController@sales')->name('reports.sales');
    Route::get('/dashboard', 'DashboardController@index')->name('reports.dashboard');
    Route::post('/sales-datatable', 'ReportsController@getSaleReportDatatable')->name('sales.datatable');
});

Route::prefix('inventory')->group(function() {
    Route::get('/', 'ReportsController@index')->name('inventory');
    Route::post('/datatable', 'ReportsController@getReportDatatable')->name('inventory.datatable');
});
