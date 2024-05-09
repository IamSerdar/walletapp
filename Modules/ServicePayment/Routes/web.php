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
        'as' => 'servicePayments.',
        'prefix' => 'service/payments',
    ], function () {
        Route::get('/', 'ServicePaymentController@index');
        Route::get('/create', 'ServicePaymentController@create')
            ->name('create');
        Route::post('/store', 'ServicePaymentController@store')
            ->name('store');
        Route::post('/change-status', 'ServicePaymentController@changeStatus')
            ->name('change-status');
        Route::get('/edit/{servicePayment}', 'ServicePaymentController@edit')
            ->name('edit');
        Route::patch('/update/{servicePayment}', 'ServicePaymentController@update')
            ->name('update');
        Route::delete('/destroy/{servicePayment}', 'ServicePaymentController@destroy')
            ->name('destroy');
    });
});
