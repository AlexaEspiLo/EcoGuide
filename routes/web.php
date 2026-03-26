<?php

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


// Esta es la página de bienvenida (la que trae Laravel)
Route::get('/', function () {
    return view('welcome');
});

// Busca esta línea y déjala así:
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
