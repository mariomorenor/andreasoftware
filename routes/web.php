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
    return view('index');
});
// Login
Route::post('login','LoginController@login');
Route::get('logout','LoginController@logout');

//Productos
Route::resource('products','ProductController')->except(['show','edit','create']);

//Clientes
Route::resource('clients','ClientController')->except(['edit','create']);

// Reportes
Route::get('report-download/{inventory}','ReportController@index');

//Depósitos
Route::resource('incomes','IncomeController');