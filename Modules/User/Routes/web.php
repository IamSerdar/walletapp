<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\User\Entities\User;

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

Route::middleware([
    'auth:web',
    'is_role:'.User::ROLE_ADMIN
    ])
    ->group(function () {
        Route::group([
            'as' => 'users',
            'prefix' => 'users',
        ], function () {
            Route::get('/', 'UserController@list');
            Route::post('create', 'UserController@create')->name('.create');
            Route::get('{user}/show', 'UserController@show')->name('.show');
            Route::get('{user}/edit', 'UserController@edit')->name('.edit');
            Route::patch('{user}/update', 'UserController@update')->name('.update');
            Route::delete('{user}/destroy', 'UserController@destroy')->name('.destroy');
        });
});
