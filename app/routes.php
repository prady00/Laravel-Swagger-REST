<?php

/*
|--------------------------------------------------------------------------
| Status Route :: status
|--------------------------------------------------------------------------
*/

Route::get('/status', function() {
     return "Feeling yummy :)";
});


/*
|--------------------------------------------------------------------------
| API Server Routes 
|--------------------------------------------------------------------------
*/
Route::api(['version' => 'v1','prefix' => 'api'], function () {

    // Users routes

    Route::post('users', 'UserController@add');
    Route::get('users/{id}', 'UserController@detail');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');
    
    // Orders routes

    Route::post('orders', 'OrderController@add');
    Route::get('orders/{id}', 'OrderController@detail');
    Route::put('orders/{id}', 'OrderController@update');
    Route::delete('orders/{id}', 'OrderController@delete');  

    // Items routes

    Route::get('items', 'ItemController@lists'); 

});


