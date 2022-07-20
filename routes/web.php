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
Route::group(['prefix' => 'customer'], function () {

    Route::get('/', 'CustomerController@index')->name('customer.index');

    Route::get('/create', 'CustomerController@create')->name('customer.create');

    Route::post('/store', 'CustomerController@store')->name('customer.store');

    Route::get('edit/{id}', 'CustomerController@getbyid');

    Route::post('update/{id}', 'CustomerController@update')->name('customer.update');

    Route::get('delete/{id}', 'CustomerController@delete');
});
Route::group(['prefix' => 'product'], function () {

    Route::get('/', 'ProductController@index')->name('product.index');

    Route::get('/create', 'ProductController@create')->name('product.create');

    Route::post('/store', 'ProductController@store')->name('product.store');

    Route::get('edit/{id}', 'ProductController@getbyid');

    Route::post('update/{id}', 'ProductController@update')->name('product.update');

    Route::get('delete/{id}', 'ProductController@delete');
});
Route::group(['prefix' => 'sales'], function () {

    Route::get('/invoice', 'SalesController@invoice')->name('sales.invoice');

    Route::get('/invoicedetails', 'SalesController@invoicedetails')->name('sales.invoicedetails');

    Route::get('/create', 'SalesController@create')->name('sales.create');

    Route::post('add-invoice', 'SalesController@AddInvoice')->name('add.invoice');

    Route::post('add-invoicedetails', 'SalesController@AddInvoiceDetails')->name('add.invoicedetails');

    Route::patch('update-invoicedetails', 'SalesController@update')->name('update.invoicedetails');

    Route::get('store', 'SalesController@store')->name('store.invoicedetails');
});
