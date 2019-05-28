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
    return view('auth/login');
});
Auth::routes();
Route::get('/dashboard', 'DashboardController@dashboard');
Route::resource('expenses', 'ExpensesController');
Route::resource('expense-category', 'ExpensesCategoryController');
Route::get('supplier/{id}', 'SupplierController@transaction');
Route::resource('supplier', 'SupplierController');
Route::get('payment','PaymentController@index');
Route::post('settled/{id}','PaymentController@settled');
Route::get('monthly-expenses','ReportController@monthlyExpenses');
Route::get('expenses-with-supplier','ReportController@expensesWithSupplier');
Route::get('profile/{id}','UserController@profile');

