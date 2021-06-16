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
Route::get('/', function () {
    return view('Auth.login');
})->name('login');

// dd(Auth::check());
Auth::routes();

  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/customer', 'HomeController@customer')->name('customer');
  Route::get('/customer-contract', 'HomeController@customer_contract')->name('customer.contract');
  Route::get('/customer/create-new', 'HomeController@customer_create')->name('customer.create');
