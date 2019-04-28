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

Route::get('/', 'InvoiceController@index')->name('invoices');

Route::get('/invoice/create', 'InvoiceController@create')->name('invoice.create');

//Store an invoice
Route::post('/invoice/store', 'InvoiceController@store')->name('invoice.store');

//Update and invoice
Route::post('/invoice/update', 'InvoiceController@update')->name('invoice.update');

//Delete an invoice
Route::post('/invoice/delete', 'InvoiceController@delete')->name('invoice.delete');

//Fetch Single Invoice
Route::get('/invoice/{id}', 'InvoiceController@edit')->name('invoice.edit');

Route::post('invoice/generate', 'InvoiceController@generateInvoice')->name('invoice.generate');


//Customer end points

//Get all customers
Route::get('/customers', 'CustomerController@index')->name('customers');

//Store an customer
Route::post('/customer/store', 'CustomerController@store')->name('customer.store');

//Update and customer
Route::put('/customer/update', 'CustomerController@update')->name('customer.update');

//Delete an customer
Route::post('/customer/delete', 'CustomerController@delete')->name('customer.delete');

//Fetch Single Customer
Route::get('/customer/{id}', 'CustomerController@edit')->name('customer.edit');


//Invoice Product End Points

//Get all invoice-products
Route::get('/invoice-products/{id}', 'InvoiceProductController@index')->name('invoice-products');

//Store an invoice-product
Route::post('/invoice-product/store', 'InvoiceProductController@store')->name('invoice-product.store');

//Update and invoice-product
Route::put('/invoice-product/update', 'InvoiceProductController@update')->name('invoice-product.update');

//Delete an invoice-product
Route::post('/invoice-product/delete', 'InvoiceProductController@delete')->name('invoice-product.delete');


Route::get('/email/invoice/{id}', 'EmailController@mail')->name('email.invoice');

