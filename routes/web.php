<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\WorkController;

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

Route::get('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'logintwo']);
Route::delete('/logout', [AuthController::class, 'destroy']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/calendar', [CalendarController::class, 'calendar']);
    Route::get('/shopping', [ShoppingController::class, 'getShopping']);
    Route::post('/shopping/update', [ShoppingController::class, 'updateShoppingList']);
    Route::get('/work', [WorkController::class, 'work']);
});


