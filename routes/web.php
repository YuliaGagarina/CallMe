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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/phones', 'PhoneDirectoryController@index'); //показать все записи по данным а справочнике
    Route::post('/phones', 'PhoneDirectoryController@store'); //добавление данных в справочник
    Route::put('/phones/{id}', 'PhoneDirectoryController@update'); //обновить, отредактировать номер по АйДи
    Route::delete('/phones/{id}', 'PhoneDirectoryController@delete'); //удалить номер по конкретному АйДи
    Route::get('/phones/{phone}', 'PhoneDirectoryController@findByNumberPhone'); //найти пользователя по номеру телефона
    Route::get('/phones/{address}', 'PhoneDirectoryController@findByAddress'); //поиск по адресу
    Route::get('/phones/{name}', 'PhoneDirectoryController@findByName'); //поиск по имени
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
