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
Route::resource('expenses', 'MealController');
Route::resource('meal-type', 'MealTypeController');
Route::resource('restaurant', 'RestaurantController');
Route::get('quick-info', 'QuickInfoController@mealExpense');
Route::get('payment-info','QuickInfoController@paymentInformation');
