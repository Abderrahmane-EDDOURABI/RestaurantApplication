<?php


Route::get('/', 'HomeController@index');

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){

    // routes for cashier
    Route::get('/cashier', 'Cashier\CashierController@index');
    Route::get('/cashier/getMenuByCategory/{category_id}', 'Cashier\CashierController@getMenuByCategory');
    Route::get('/cashier/getTable', 'Cashier\CashierController@getTables');
    Route::get('/cashier/getSaleDetailsByTable/{table_id}', 'Cashier\CashierController@getSaleDetailsByTable');
    
    Route::post('/cashier/orderFood', 'Cashier\CashierController@orderFood');
    Route::post('/cashier/deleteSaleDetail', 'Cashier\CashierController@deleteSaleDetail');
    Route::post('/cashier/increaseQuantity', 'Cashier\CashierController@increaseQuantity');
    Route::post('/cashier/decreaseQuantity', 'Cashier\CashierController@decreaseQuantity');
    
    Route::post('/cashier/confirmOrderStatus', 'Cashier\CashierController@confirmOrderStatus');
    Route::post('/cashier/savePayment', 'Cashier\CashierController@savePayment');
    Route::get('/cashier/showReceipt/{saleID}', 'Cashier\CashierController@showReceipt');
});

Route::middleware(['auth', 'VerifyAdmin'])->group(function(){
    Route::get('/management', function(){
        return view('management.index');
    });
    //routes for management
    Route::resource('management/category','Management\CategoryController');
    Route::resource('management/menu','Management\MenuController');
    Route::resource('management/table','Management\tableController');
    Route::resource('management/user','Management\UserController');
    //routes for report
    
    Route::get('/report', 'Report\ReportController@index');
    Route::get('/report/show', 'Report\ReportController@show');
    
    // Export to excel
    Route::get('/report/show/export', 'Report\ReportController@export');
});

