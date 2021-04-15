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

//ROTAS DO ADMINISTRATIVO

//Items
Route::get('/admin/items-menu', 'Admin\ItemController@list')->name('admin.items.list');
Route::get('/admin/items-menu/details/{id}', 'Admin\ItemController@details')->name('admin.items.details');
Route::put('/admin/items-menu/update/{id}', 'Admin\ItemController@update')->name('admin.items.update');
Route::get('/admin/items-menu/new', 'Admin\ItemController@new')->name('admin.items.new');
Route::post('/admin/items-menu', 'Admin\ItemController@create')->name('admin.items.create');
Route::get('/admin/items-menu/delete/{id}', 'Admin\ItemController@destroy')->name('admin.items.delete');

//Groups
Route::get('/admin/groups', 'Admin\GroupController@list')->name('admin.groups.list');
Route::get('/admin/groups/details/{id}', 'Admin\GroupController@details')->name('admin.groups.details');


