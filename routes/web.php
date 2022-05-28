<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
});

Route::group(['prefix' => 'manager', 'middleware' => ['auth']], function () {
    Route::get('/', [ManagerController::class, 'index'])->name('manager');
    Route::patch('/reply/{application}', [ManagerController::class, 'reply'])->name('manager.reply');
});

Route::group(['prefix' => 'client', 'middleware' => ['auth']], function () {
    Route::get('/', [ClientController::class, 'index'])->name('client');
    Route::post('/create', [ClientController::class, 'create'])->name('client.app.create');
    Route::get('/reset-date', [ClientController::class, 'resetDate'])->name('client.app.resetDate');
});
