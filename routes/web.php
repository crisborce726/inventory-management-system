<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Lockscreen;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

//Access website/storage-link after deploying to link the storage to public
Route::get('/storage-link', function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder,$linkFolder);
    echo "Link Success";
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//===================================================================================//
// ==================lock screen ====================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(Lockscreen::class)->group(function () {
    Route::get('locked', 'locked')->middleware('auth')->name('screen.locked');
    Route::post('unlock', 'unlock')->name('login.unlock');
});


//===================================================================================//
//==============Patient Controller===================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(PatientController::class)->group(function(){
    Route::get('patients', 'index')->name('patients.index');
    Route::post('patients', 'store')->name('patients.store');
    Route::get('patients.{id}', 'show')->name('patients.show');
    Route::get('edit.patients.{id}', 'edit')->name('patients.edit');
    Route::put('patient.{id}', 'update')->name('patients.update');
    
});

//===================================================================================//
//==============Categories Controller================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(CategoryController::class)->group(function(){
    Route::get('categories', 'index')->name('categories.index');
    Route::post('categories', 'store')->name('categories.store');
    Route::put('categories.{id}', 'update')->name('categories.update');
    Route::delete('categories', 'delete')->name('categories.delete');
});

//===================================================================================//
//==============Stocks Controller====================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(StockController::class)->group(function(){
    Route::get('stocks', 'index')->name('stocks.index');
    Route::post('stocks', 'store')->name('stocks.store');
    Route::get('stocks.{id}', 'edit')->name('stocks.edit');
    Route::put('stocks.{id}', 'update')->name('stocks.update');
    Route::delete('stocks', 'delete')->name('stocks.delete');
});
Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF'])->name('stocks.pdf');

//===================================================================================//
//==============Transactionsoller====================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(TransactionController::class)->group(function(){
    Route::get('transactions', 'index')->name('transactions.index');
    Route::post('transactions', 'store')->name('transactions.store');
});

//===================================================================================//
//==============Transactionsoller====================================================//
//===================================================================================//
//index => get | store => post | create => get | show => get | update => put | edit => get | destroy => delete
Route::controller(UserController::class)->group(function(){
    Route::put('users.{id}', 'update')->name('users.update');
    Route::get('profile.{id}', 'profile')->name('edit.profile');
    Route::put('change.password/{id}', 'changePassword')->name('change.password');
});