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
    
    Route::get('/work', [WorkController::class, 'work'])->name('work');

    Route::get('/finder', [FinderItemsController::class, 'finder'])->name('finder');
    Route::get('/finder/add', [FinderItemsController::class, 'showAddItem'])->name('finder.show.add');
    Route::post('/finder/create', [FinderItemsController::class, 'createItem'])->name('finder.create');
    Route::get('/finder/edit/{id}', [FinderItemsController::class, 'showEditItem'])->name('finder.show.edit');
    Route::patch('/finder/update', [FinderItemsController::class, 'updateItem'])->name('finder.update');
    Route::get('/finder/search', [FinderItemsController::class, 'searchItem'])->name('finder.search');
    Route::match(['get', 'post'],'/finder/tags/{tag}', [FinderItemsController::class, 'sortByTags'])->name('finder.tags'); // not posting/saving anything, just using post so to url is passed only name and to backend id
    Route::get('/finder/location/{location}', [FinderItemsController::class, 'sortByLocation'])->name('finder.location');
    Route::delete('/finder/delete/{id}', [FinderItemsController::class, 'deleteItem'])->name('finder.delete');

});


