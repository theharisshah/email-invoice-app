<?php
Route::prefix('v1')->namespace('v1')->group(function () {

    //Invoice end points

    //Get all invoices
    Route::get('/invoices', 'InvoiceController@index')->name('invoices');

    //Store an invoice
    Route::post('/invoice/store', 'InvoiceController@store')->name('invoice.store');

    //Update and invoice
    Route::put('/invoice/update', 'InvoiceController@update')->name('invoice.update');

    //Delete an invoice
    Route::post('/invoice/delete', 'InvoiceController@delete')->name('invoice.delete');

    //Fetch Single Invoice
    Route::get('/invoice/{id}', 'InvoiceController@show')->name('invoice.show');


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
    Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');


    //Invoice Product End Points

    //Get all invoice-products
    Route::get('/invoice-products', 'InvoiceController@index')->name('invoice-products');

    //Store an invoice-product
    Route::post('/invoice-product/store', 'InvoiceController@store')->name('invoice-product.store');

    //Update and invoice-product
    Route::put('/invoice-product/update', 'InvoiceController@update')->name('invoice-product.update');

    //Delete an invoice-product
    Route::post('/invoice-product/delete', 'InvoiceController@delete')->name('invoice-product.delete');

    //Fetch Single Invoice Product
    Route::get('/invoice-product/{id}', 'InvoiceController@show')->name('invoice.show');



});