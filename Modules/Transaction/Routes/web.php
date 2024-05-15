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
        // 'is_role:'.User::ROLE_ADMIN
    ])
    ->group(function () {
        Route::group([
            'as' => 'transactions.',
            'prefix' => 'transactions',
        ], function () {
            Route::get('/', 'TransactionController@index');
            Route::get('/create', 'TransactionController@create')
                ->name('create');
            Route::post('/store', 'TransactionController@store')
                ->name('store');
            Route::post('/change-status', 'TransactionController@changeStatus')
                ->name('change-status');
            Route::get('/edit/{transaction}', 'TransactionController@edit')
                ->name('edit');
            Route::patch('/update/{transaction}', 'TransactionController@update')
                ->name('update');
            Route::delete('/destroy/{transaction}', 'TransactionController@destroy')
                ->name('destroy');
        });
});
