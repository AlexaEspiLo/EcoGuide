<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Page;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SearchController; // <--- Agregado

// Rutas para solicitar el enlace
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Rutas para resetear la contraseña
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Autentificación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('home');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email');
})->name('login.post');

// --- RUTAS DE REGISTRO ---
Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);
    return redirect()->route('home');
})->name('register.post');

// --- HOME Y FUNCIONALIDAD ---
Route::get('/', [HomeController::class, 'index'])->name('home1');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/like', [TipController::class, 'like'])->middleware('auth');

// Ruta de Búsqueda actualizada
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/tip/{id}', [TipController::class, 'show'])->name('tip.show');

// --- PRIVACIDAD ---
Route::get('/privacidad', function () {
    return view('auth.privacidad');
})->name('privacidad')->middleware('auth');

Route::post('/privacidad-aceptar', function () {
    $user = Auth::user();
    $user->privacy_accepted = true;
    $user->save();
    return redirect()->route('home');
})->name('privacidad.aceptar')->middleware('auth');

// --- LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Creación de Páginas desde Admin
Route::get('/page/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('user.info', compact('page'));
})->name('page.show');

// --- GOOGLE AUTH ---
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);