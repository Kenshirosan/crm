<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:edit_user'])->group(function () {
    Route::get('/home', 'HomeController@index');

    Route::get('/', 'PagesController@index');
    Route::get('/users', 'UsersController@index')->name('home');
    Route::get('/user/{id}', 'UsersController@show')->name('user');

    Route::post('/create/address', 'AddressesController@store');
    Route::patch('/update/address', 'AddressesController@update');
});



Route::get('/countries', 'AddressesController@getCountries');
Route::get('/states/{id}', 'AddressesController@getStates');
Route::get('/cities/{id}', 'AddressesController@getCities');
Auth::routes();

