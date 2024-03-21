<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FinderItemsController;
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

Route::get('/', [AuthController::class, 'index'])->name('homepage');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
    Route::get('/shopping', [ShoppingController::class, 'getShopping'])->name('shopping');
    Route::post('/shopping', [ShoppingController::class, 'updateShoppingList'])->name('shopping.update');
    //it has no name and yet working in MainLayout.vue there is no route, if added then here it needs name
    Route::get('/work', [WorkController::class, 'work'])->name('work');
    Route::get('/finder', [FinderItemsController::class, 'showItems'])->name('finder');
});


