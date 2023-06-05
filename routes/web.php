<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'inicio'])->name('inicio');
Route::get('/historia', [MainController::class, 'historia'])->name('historia');
Route::get('/menu', [MainController::class, 'menu'])->name('menu');
Route::get('/contacto', [MainController::class, 'contacto'])->name('contacto');

Route::resource('reservas', 'App\Http\Controllers\ReservaController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
