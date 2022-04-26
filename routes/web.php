<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;

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

//welcome page
Route::get('/', function () {
    return view('welcome');
});

//feedback
Route::post('/home', [UserController::class, 'getfeedback'])->name('thankyou');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    //dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    //add liters
    Route::post('/add', [UserController::class, 'add'])->name('add');
    //user dashboard
    Route::get('/userdashboard', [HomeController::class, 'index'])->name('userdashboard');
    //update use profile
    Route::get('/updateprofile', [UserController::class, 'updateProfile'])->name('updateprofile');
    //save updated user
    Route::post('/updatesaveuser', [UserController::class, 'updateSaveUser'])->name('updatesaveuser');
    //get add liters view
    Route::get('/add', function () {
        return view('add');
    });
    //admindashboard
    Route::get('/admindashboard', [AdminController::class, 'showalldata'])->name('admindashboard')->middleware('is_admin');
    //update admin profile
    Route::get('/updateadminprofile', [AdminController::class, 'updateProfile'])->name('updateadminprofile');
    //save updated admin
    Route::post('/updatesaveuser', [AdminController::class, 'updateSaveUser'])->name('updatesaveuser');
    //superadmin dashboard
    Route::get('/superadmindashboard', [AdminController::class, 'superadmindata'])->name('superadmindashboard')->middleware('is_superadmin');
    //show admin dashboard in superadmin page
    Route::get('/showalladmindashboard/{area}', [AdminController::class, 'showalladmindashboard'])->name('showalladmindashboard');
    //show all users of particular admin
    Route::get('/showallusers', [AdminController::class, 'showallusers'])->name('showallusers');
    //delete user
    Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
    //show deleted users
    Route::get('/showpastusers', [AdminController::class, 'showpastusers'])->name('showpastusers');
    //get view of add admin
    Route::get('/addadmin', function () {
        return view('addadmin');
    });
    //add admin
    Route::post('/addadmin', [AdminController::class, 'addadmin'])->name('addadmin');
    //update superadmin profile
    Route::get('/updatesuperadminprofile', [AdminController::class, 'updatesuperadminProfile'])->name('updatesuperadminprofile');
    //save updated superadmin
    Route::post('/updatesavesuperadmin', [AdminController::class, 'updatesuperadminSaveUser']);
    //delete admin
    Route::get('/deleteadmin/{id}', [AdminController::class, 'deleteadmin']);
    //show deleted admins
    Route::get('/showpastadmins', [AdminController::class, 'showpastadmins'])->name('showpastadmins');
});
//get the view of checkout page
Route::get('/checkout/{email}/total/{total}', [CheckoutController::class, 'checkout']);
//submit credit-card details
Route::post('checkout', [HomeController::class, 'welcome'])->name('checkout.credit-card');
//sending mail to all users
Route::get('send/mail', [AdminController::class, 'send_mail'])->name('send_mail')->middleware('is_superadmin');
