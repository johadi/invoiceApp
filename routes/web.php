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

//admin routes
Route::get('/','AdminController@index');
Route::post('/login','AdminController@store');
Route::get('/dashboard','AdminController@dashboard');
Route::get('/settings','AdminController@getSettings');
Route::post('/settings','AdminController@postSettings');
Route::get('/logout','AdminController@destroy');

//invoice routes
Route::get('/invoice/generate/{status}','InvoiceController@generate');
Route::get('/invoice/create','InvoiceController@create');
Route::post('/invoice/add-item/{item_query}','InvoiceController@storeItem');
Route::get('/invoice/show', 'InvoiceController@getShow');
Route::post('/invoice/show', 'InvoiceController@postShow');
Route::get('/invoice/show/{status}', 'InvoiceController@index');//handle various invoice display options(view,edit, remove etc)
Route::get('/invoice/view/{invoice}', 'InvoiceController@view');//handle invoice view
Route::get('/invoice/edit/{invoice}', 'InvoiceController@update');//handle invoice edit view
Route::get('/invoice/delete/{invoice}', 'InvoiceController@destroy');//handle invoice remove


//client routes
Route::get('/client/create', 'ClientController@create');
Route::post('/client/create','ClientController@store');
Route::get('/client/show', 'ClientController@show');//show client info
Route::get('/client/show/{status}', 'ClientController@index');//handles various client display options
