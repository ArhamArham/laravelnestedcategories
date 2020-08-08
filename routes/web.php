<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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

Route::get('/', 'CategoryController@getCategories');
Route::get('/create', 'CategoryController@create');
Route::post('/category', 'CategoryController@catStore')->name('catstore');
Route::post('/subcategory', 'CategoryController@subCatStore')->name('subcatstore');
Route::post('/childcategory', 'CategoryController@childCatStore')->name('childcatstore');
Route::get('/edit/{id}',"CategoryController@edit")->name('edit');
Route::put('/catupdate/{id}','CategoryController@catupdate')->name('catupdate');
Route::delete('/delete/{id}', 'CategoryController@destroy')->name('category.destroy');