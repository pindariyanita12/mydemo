<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/add', [UserController::class, 'add'])->name('add');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/updateprofile', [UserController::class, 'updateProfile'])->name('updateprofile');
    Route::post('/updatesaveuser', [UserController::class, 'updateSaveUser'])->name('updatesaveuser');
    Route::get('/add', function () {
        return view('add');
    });
    Route::get('/admindashboard', [AdminController::class, 'showalldata'])->name('admindashboard')->middleware('is_admin');
Route::get('/updateadminprofile', [AdminController::class, 'updateProfile'])->name('updateadminprofile');
Route::post('/updatesaveuser', [AdminController::class, 'updateSaveUser'])->name('updatesaveuser');
Route::get('/superadmindashboard', [AdminController::class, 'superadmindata'])->name('superadmindashboard');
Route::get('/showalladmindashboard', [AdminController::class, 'showalladmindashboard'])->name('showalladmindashboard');

});
// Route::get('/admindashboard', [AdminController::class, 'showalldata'])->name('admindashboard');
