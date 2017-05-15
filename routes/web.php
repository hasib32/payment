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
    return view('home');
})->name('home');

Route::get('/payment', 'PaymentDataController@getPaymentInfo')->name('payment');
Route::get('/company', 'PaymentDataController@getCompanyPaymentInfo')->name('company');
Route::get('/hospital', 'PaymentDataController@getHospitalPaymentInfo')->name('hospital');
