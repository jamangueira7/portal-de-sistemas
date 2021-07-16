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

Route::get('/', 'FreeController@index')->name('free.index')->middleware('login');
Route::get('/login', 'FreeController@login')->name('free.login')->middleware('login');
Route::get('/logout', 'FreeController@logout')->name('free.logout')->middleware('login');
Route::post('/authenticate', 'FreeController@authenticate')->name('free.authenticate')->middleware('login');

//PORTAL
Route::get('/portal/{page}/{item?}', 'AuthPageController@index')->name('auth.pages')->middleware('login');

//AJAX
Route::post('/favorite/alter', 'Admin\FavoriteController@ajaxAlterFavorite')->name('portal.ajax.favorite.alter')->middleware('login');
Route::post('/favorite/update', 'Admin\FavoriteController@ajaxUpdateFavorite')->name('portal.ajax.favorite.update')->middleware('login');
Route::post('/groupsbypage', 'Admin\ItemController@ajaxGroupByPage')->name('admin.ajax.groups.page')->middleware('login');
Route::post('/itemsbypage', 'Admin\ItemController@ajaxItemsByPage')->name('admin.ajax.groups.items')->middleware('login');
Route::post('/itemsbyfather', 'Admin\ItemController@ajaxItemsByFather')->name('admin.ajax.groups.father')->middleware('login');


//ROTAS DO ADMINISTRATIVO

//Items
Route::get('/admin/items-menu', 'Admin\ItemController@list')->name('admin.items.list')->middleware('login');
Route::get('/admin/items-menu/details/{id}', 'Admin\ItemController@details')->name('admin.items.details')->middleware('login');
Route::put('/admin/items-menu/update/{id}', 'Admin\ItemController@update')->name('admin.items.update')->middleware('login');
Route::get('/admin/items-menu/new', 'Admin\ItemController@new')->name('admin.items.new')->middleware('login');
Route::post('/admin/items-menu', 'Admin\ItemController@create')->name('admin.items.create')->middleware('login');
Route::get('/admin/items-menu/delete/{id}', 'Admin\ItemController@destroy')->name('admin.items.delete')->middleware('login');

//groups

Route::get('/admin/groups', 'Admin\GroupController@list')->name('admin.groups.list')->middleware('login');
Route::get('/admin/groups/details/{id}', 'Admin\GroupController@details')->name('admin.groups.details')->middleware('login');
Route::get('/admin/groups/new', 'Admin\GroupController@new')->name('admin.groups.new')->middleware('login');
Route::post('/admin/groups', 'Admin\GroupController@create')->name('admin.groups.create')->middleware('login');

//Users
Route::get('/admin/users', 'Admin\UserController@list')->name('admin.users.list')->middleware('login');
Route::get('/admin/users/details/{id}', 'Admin\UserController@details')->name('admin.users.details')->middleware('login');
Route::put('/admin/users/update/{id}', 'Admin\UserController@update')->name('admin.users.update')->middleware('login');
Route::get('/admin/users/delete/{id}', 'Admin\UserController@destroy')->name('admin.users.delete')->middleware('login');

//Responsible
Route::get('/admin/responsible', 'Admin\ResponsibleController@list')->name('admin.responsible.list')->middleware('login');
Route::get('/admin/responsible/details/{id}', 'Admin\ResponsibleController@details')->name('admin.responsible.details')->middleware('login');

//pages
Route::get('/admin/pages', 'Admin\PageController@list')->name('admin.pages.list')->middleware('login');
Route::get('/admin/pages/details/{id}', 'Admin\PageController@details')->name('admin.pages.details')->middleware('login');
Route::put('/admin/pages/update/{id}', 'Admin\PageController@update')->name('admin.pages.update')->middleware('login');
Route::get('/admin/pages/new', 'Admin\PageController@new')->name('admin.pages.new')->middleware('login');
Route::post('/admin/pages', 'Admin\PageController@create')->name('admin.pages.create')->middleware('login');
Route::get('/admin/pages/delete/{id}', 'Admin\PageController@destroy')->name('admin.pages.delete')->middleware('login');


//adm banco
Route::get('/admin/database', 'Admin\DatabaseController@index')->name('admin.database.details')->middleware('login');
Route::get('/admin/database/use/{name}', 'Admin\DatabaseController@use')->name('admin.database.use')->middleware('login');
Route::get('/admin/database/delete/{name}', 'Admin\DatabaseController@destroy')->name('admin.database.use')->middleware('login');
Route::get('/admin/database/generate', 'Admin\DatabaseController@generate')->name('admin.database.generate')->middleware('login');
Route::get('/admin/database/download/{name}', 'Admin\DatabaseController@download')->name('admin.database.download')->middleware('login');
Route::get('/admin/database/reset', 'Admin\DatabaseController@reset')->name('admin.database.reset')->middleware('login');
Route::post('/admin/database/create', 'Admin\DatabaseController@create')->name('admin.database.create')->middleware('login');
