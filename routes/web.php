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

Route::get('/', 'FreeController@index');
Route::get('/login', 'FreeController@login');
Route::get('/logout', 'FreeController@login');

Route::get('/admin/items-menu', 'AdminController@list')->name('admin.items.list');
Route::get('/admin/items-menu/{id}', 'AdminController@details')->name('admin.items.details');
Route::put('/admin/items-menu/{id}', 'AdminController@update')->name('admin.items.update');


