<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
    ])
->prefix(LaravelLocalization::setLocale())
->group(function () {
        Route::get('login', 'LoginController@showLoginForm');
        Route::post('login','LoginController@login')->name('login');
});

Route::middleware([
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
    'auth:web'])
->prefix(LaravelLocalization::setLocale())
->group(function () {
    Route::get('/', 'HomeController@index')->name('manager');
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::patch('profile', 'HomeController@profileUpdate')->name('profile.update');
    Route::post('logout', 'LogoutController')->name('logout');
});
