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
    return view('welcome');
});
Route::get('app/get_slots', 'HomeConteroller@getSlots');
Route::get('app/get_departments', 'HomeConteroller@getDepartments');
Route::get('app/getData', 'HomeConteroller@getData');

