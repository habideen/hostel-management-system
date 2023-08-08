<?php

use App\Http\Controllers\WEB\Admin\BlockController;
use App\Http\Controllers\WEB\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Admin\HallController;
use App\Http\Controllers\WEB\Admin\SessionController;
use App\Http\Controllers\WEB\Admin\StudentController;
use App\Http\Controllers\WEB\Admin\UserController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\LogoutController;
use App\Http\Controllers\WEB\Student\BookingController;
use App\Http\Controllers\WEB\Student\DashboardController as StudentDashboardController;
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
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');



Route::prefix('admin')
->middleware(['auth'])
->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('add_hall', [HallController::class, 'index']);
    Route::get('update_hall', [HallController::class, 'index']);
    Route::post('update_hall', [HallController::class, 'updateHall']);
    Route::get('manage_hall', [HallController::class, 'hallList']);

    Route::get('add_block', [BlockController::class, 'index']);
    Route::get('update_block', [BlockController::class, 'index']);
    Route::post('update_block', [BlockController::class, 'updateBlock']);
    Route::get('manage_block', [BlockController::class, 'blockList']);

    Route::get('update_session', [SessionController::class, 'index']);
    Route::post('update_session', [SessionController::class, 'updateSession']);

    Route::get('warden_registration', [UserController::class, 'index']);
    Route::get('update_warden', [UserController::class, 'index']);
    Route::post('update_warden', [UserController::class, 'updateWarden']);
    Route::get('manage_warden/{account_type}', [UserController::class, 'userList']);
    Route::get('manage_warden', [UserController::class, 'wardenList']);

    Route::get('upload_student', [StudentController::class, 'index']);
    Route::post('upload_student', [StudentController::class, 'uploadStudent']);
    Route::get('manage_student', [StudentController::class, 'wardenList']);

    Route::get('rooms', [AdminBookingController::class, 'index']);
    Route::get('generate_rooms', [AdminBookingController::class, 'generateRooms']);
    Route::get('bed_space_info', [AdminBookingController::class, 'roomInfo']);
});



Route::prefix('student')
->middleware(['auth'])
->group(function() {
    Route::get('/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/book_for_hostel', [BookingController::class, 'index']);

});
