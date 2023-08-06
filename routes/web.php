<?php

use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login']);



Route::prefix('admin')
->middleware(['auth'])
->group(function() {
    Route::get('/', [DashboardController::class, 'index']);
});
