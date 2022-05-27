<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\DashboardController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('/', DashboardController::class)->name('index', 'admin');
});

Route::group(['prefix' => 'client', 'middleware' => ['auth']], function () {
    Route::resource('/', ClientController::class)->name('index', 'client');
});

Route::group(['prefix' => 'manager', 'middleware' => ['auth']], function () {
    Route::resource('/', ManagerController::class)->name('index', 'manager');
});
