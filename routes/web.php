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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');

    Route::post('users/deleteMultiple', 'UserController@deleteMultiple');
    Route::get('users/datatables', 'UserController@datatables');
    Route::resource('users','UserController');

    //Product
    Route::get('product/datatables','ProductController@datatables');
    Route::resource('product','ProductController');

    //Product Category
    Route::post('product-category/deleteMultiple', 'ProductCategoryController@deleteMultiple');
    Route::resource('product-category', 'ProductCategoryController');

    //Product Unit
    Route::post('product-unit/deleteMultiple', 'ProductUnitController@deleteMultiple');
    Route::resource('product-unit', 'ProductUnitController');

    //Datatables
    Route::get('datatables/productCategory', 'ProductCategoryController@datatables');
    Route::get('datatables/productUnit', 'ProductUnitController@datatables');
    Route::get('datatables/product', 'ProductController@datatables');

    //Select2
    Route::get('select2/productCategory', 'ProductCategoryController@select2');
    Route::get('select2/productUnit', 'ProductUnitController@select2');
});
