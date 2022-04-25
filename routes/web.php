<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;

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
Route::post('/home', [UserController::class, 'getfeedback'])->name('thankyou');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/add', [UserController::class, 'add'])->name('add');
    Route::get('/userdashboard', [HomeController::class, 'index'])->name('userdashboard');
    Route::get('/updateprofile', [UserController::class, 'updateProfile'])->name('updateprofile');
    Route::post('/updatesaveuser', [UserController::class, 'updateSaveUser'])->name('updatesaveuser');
    Route::get('/add', function () {
        return view('add');
    });
    Route::get('/admindashboard', [AdminController::class, 'showalldata'])->name('admindashboard')->middleware('is_admin');
    Route::get('/updateadminprofile', [AdminController::class, 'updateProfile'])->name('updateadminprofile');
    Route::post('/updatesaveuser', [AdminController::class, 'updateSaveUser'])->name('updatesaveuser');
    Route::get('/superadmindashboard', [AdminController::class, 'superadmindata'])->name('superadmindashboard')->middleware('is_superadmin');
    Route::get('/showalladmindashboard/{area}', [AdminController::class, 'showalladmindashboard'])->name('showalladmindashboard');
    Route::get('/showallusers', [AdminController::class, 'showallusers'])->name('showallusers');
    Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
    Route::get('/showpastusers', [AdminController::class, 'showpastusers'])->name('showpastusers');
    Route::get('/addadmin', function () {
        return view('addadmin');
    });
    Route::post('/addadmin', [AdminController::class, 'addadmin'])->name('addadmin');
    Route::get('/updatesuperadminprofile', [AdminController::class, 'updatesuperadminProfile'])->name('updatesuperadminprofile');
    Route::get('/deleteadmin/{id}', [AdminController::class, 'deleteadmin']);
    Route::get('/showpastadmins', [AdminController::class, 'showpastadmins'])->name('showpastadmins');
});
Route::get('/checkout/{email}/total/{total}',[CheckoutController::class,'checkout']);
Route::post('checkout',[HomeController::class,'welcome'])->name('checkout.credit-card');
Route::get('send/mail', [AdminController::class, 'send_mail'])->name('send_mail')->middleware('is_superadmin');
