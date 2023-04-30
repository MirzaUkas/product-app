<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('products', ProductController::class)->middleware('auth:admin');
Route::resource('users', UserController::class)->middleware('auth:admin');
Route::resource('staffs', StaffController::class)->middleware('auth:admin');


Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/staff',[LoginController::class,'showStaffLoginForm'])->name('staff.login-view');
Route::post('/staff',[LoginController::class,'staffLogin'])->name('staff.login');
Route::get('/staff/dashboard',[App\Http\Controllers\StaffController::class, 'index'])->name('staff.dashboard')->middleware('auth:staff');

Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard',[App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

Route::post('/login',[LoginController::class,'authenticate'])->name('auth.login');
