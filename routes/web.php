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

//Users
Route::get('/admin/users', 'Admin\UserController@list')->name('admin.users.list');
Route::get('/admin/users/details/{id}', 'Admin\UserController@details')->name('admin.users.details');
Route::put('/admin/users/update/{id}', 'Admin\UserController@update')->name('admin.users.update');
Route::get('/admin/users/delete/{id}', 'Admin\UserController@destroy')->name('admin.users.delete');

//pages
Route::get('/admin/pages', 'Admin\PageController@list')->name('admin.pages.list');
Route::get('/admin/pages/details/{id}', 'Admin\PageController@details')->name('admin.pages.details');
Route::put('/admin/pages/update/{id}', 'Admin\PageController@update')->name('admin.pages.update');
Route::get('/admin/pages/new', 'Admin\PageController@new')->name('admin.pages.new');
Route::post('/admin/pages', 'Admin\PageController@create')->name('admin.pages.create');
Route::get('/admin/pages/delete/{id}', 'Admin\PageController@destroy')->name('admin.pages.delete');
