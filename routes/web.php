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

Route::get('/', 'HomeController@index');

Route::get('/sales', 'SalesController@index');


Route::post('/createProdust', 'ProductsController@createProduct');
Route::post('/updateProduct','ProductsController@updateProduct');
Route::get('/deleteProducts/{id}','ProductsController@deleteProducts');




