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
    return view('auth.login');
})->name('login');

// dd(Auth::check());
Auth::routes();
// --- COMPANY ---
  // --- EMPLOYEE ---
  Route::get('/home', 'EmployeeController@index')->name('our.home');
  Route::get('/employee/create-new', 'EmployeeController@employee_create')->name('our.create');
  // --- END EMPLOYEE ---



  // --- MACHINE-COPY ---
  Route::get('/machine-copy', 'MachineController@machine_copy')->name('our.machine_copy');
  Route::get('/machine/machine-new', 'MachineController@machine_copy_create')->name('our.machine_copy_create');
  // --- INSERT ---
  Route::post('/machine/machine-insert', 'MachineController@machine_insert')->name('machine.insert');
  // --- EDIT ---
  Route::get('/machine/edit/{id}', 'MachineController@machine_edit')->name('customer.edit');
  // --- END MACHINE-COPY ---



  // --- CUSTOMER ---
  Route::get('/customer', 'HomeController@customer')->name('customer.index');
  Route::get('/customer/create-new', 'HomeController@customer_create')->name('customer.create');
  // --- INSERT ---
  Route::post('/customer/create-insert', 'HomeController@customer_insert')->name('customer.insert');
  Route::get('/FindDistrict', 'HomeController@findDistrict');
  Route::get('/FindSubDistrict', 'HomeController@findSubDistrict');
  // --- EDIT ---
  Route::get('/customer/edit/{id}', 'HomeController@customer_edit')->name('customer.edit');
  //  -- DOWNLOAD --
  Route::get('/Download-Files/customer/{id}/{files}','ResearchController@DownloadFile')->name('DownloadFile.customer');

  // --- END CUSTOMER ---



  // --- CUSTOMER-CONTRACT ---
  Route::get('/customer-contract', 'HomeController@customer_contract')->name('customer.contract');
  Route::get('/customer/contract-new/{id}', 'HomeController@customer_contract_create')->name('customer_contract.create');
  // -- Select2 --
  Route::get('/Getuser_central', array('as' => 'Select2.ajax.get.customer.contract', 'uses' => 'HomeController@List_Serial_Machine'));
  // --- INSERT ---
  Route::post('/customer/contract-insert', 'HomeController@customer_contract_insert')->name('customer_contract.insert');
  // --- EDIT ---
  Route::get('/customer/contract-edit/{id}', 'HomeController@customer_contract_edit')->name('customer_contract.edit');
  // --- END CUSTOMER-CONTRACT ---
