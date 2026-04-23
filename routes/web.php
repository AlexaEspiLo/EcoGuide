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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


// --- RECUPERACIÓN DE CONTRASEÑA ---
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
        'email' => 'Las credenciales no coinciden.',
    ]);
})->name('login.post');

// --- RUTAS DE REGISTRO ---
Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

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


// Ruta de Búsqueda actualizada
Route::get('/search', [SearchController::class, 'search'])->name('search');

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
Route::get('/', function () {return redirect()->route('home');});
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/like', [TipController::class, 'like'])->middleware('auth');
Route::get('/tip/{id}', [TipController::class, 'show'])->name('tip.show');
Route::get('/tips/filter', [HomeController::class, 'filter'])->name('tips.filter');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// --- LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Ruta para visualizar la vista de administrador sin validación de usuario aún
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/categories', function () {
    return view('admin.categories');
})->name('categories');

Route::get('/tips', function () {
    return view('admin.tips');
})->name('tips');

Route::get('/users', function () {
    return view('admin.users');
})->name('users');

Route::get('/info-pages', function () {
    return view('admin.info-pages');
})->name('info-pages');

Route::get('/account', function () {
    return view('admin.account');
})->name('account');


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

// --- TIPS ACTIONS ---
Route::get('/tips/create', [TipController::class, 'create'])->name('tips.create');
Route::post('/tips', [TipController::class, 'store'])->name('tips.store');
Route::get('/tips/{id}/edit', [TipController::class, 'edit'])->name('tips.edit')->middleware('auth');
Route::patch('/tips/{id}', [TipController::class, 'update'])->name('tips.update')->middleware('auth');
Route::delete('/tips/{id}', [TipController::class, 'destroy'])->middleware('auth')->name('tips.destroy');
