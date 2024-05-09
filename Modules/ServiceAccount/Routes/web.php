<?php

use Illuminate\Support\Facades\Route;
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
            'as' => 'serviceAccounts.',
            'prefix' => 'service/accounts',
        ], function () {
            Route::get('/', 'ServiceAccountController@index');
            Route::get('/create', 'ServiceAccountController@create')
                ->name('create');
            Route::post('/store', 'ServiceAccountController@store')
                ->name('store');
            Route::post('/change-status', 'ServiceAccountController@changeStatus')
                ->name('change-status');
            Route::get('/edit/{serviceAccount}', 'ServiceAccountController@edit')
                ->name('edit');
            Route::patch('/update/{serviceAccount}', 'ServiceAccountController@update')
                ->name('update');
            Route::delete('/destroy/{serviceAccount}', 'ServiceAccountController@destroy')
                ->name('destroy');
        });
});
