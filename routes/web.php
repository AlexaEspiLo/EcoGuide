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
use App\Http\Controllers\ProfileController;


// --- RECUPERACIÓN DE CONTRASEÑA ---
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- PÁGINA DE INICIO ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- LOGIN ---
Route::get('/login', fn() => view('auth.login'))->name('login');

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
        'email' => 'Las credenciales no coinciden.',
    ]);
})->name('login.post');

// --- REGISTRO ---
Route::get('/register', fn() => view('auth.register'))->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'privacy_accepted' => false,
    ]);

    Auth::login($user);

    return redirect()->route('privacidad');
})->name('register.post');

// --- PRIVACIDAD ---
Route::get('/privacidad', fn() => view('auth.privacidad'))
    ->middleware('auth')
    ->name('privacidad');

Route::post('/privacidad-aceptar', function () {
    $user = Auth::user();
    $user->privacy_accepted = true;
    $user->save();

    return redirect()->route('home');
})->middleware('auth')->name('privacidad.aceptar');

// --- HOME Y FUNCIONALIDADES ---
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/like', [TipController::class, 'like'])->middleware('auth');
Route::get('/search', [Controller::class, 'index'])->middleware('auth')->name('search');
Route::get('/tip/{id}', [TipController::class, 'show'])->name('tip.show');
Route::get('/tips/filter', [HomeController::class, 'filter'])->name('tips.filter');

// --- LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// PERFIL
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('perfil');

Route::get('/account', [ProfileController::class, 'account'])
    ->middleware('auth')
    ->name('account');

// ACTUALIZAR
Route::patch('/account/update', [ProfileController::class, 'updateAccount'])
    ->middleware('auth')
    ->name('account.update');

Route::post('/account/avatar', [ProfileController::class, 'updateAvatar'])
    ->middleware('auth')
    ->name('account.avatar');

// EDITAR TIPS
Route::get('/tip/{id}/edit', [TipController::class, 'edit'])
    ->middleware('auth')
    ->name('tip.edit');

// --- PÁGINAS DINÁMICAS ---
Route::get('/page/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('user.info', compact('page'));
})->name('page.show');

// --- GOOGLE LOGIN ---
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);