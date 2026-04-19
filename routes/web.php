<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GoogleController;

// --- PÁGINA DE INICIO ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- AUTENTICACIÓN (LOGIN) ---
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
        // Al loguearse, intentamos ir a home (el middleware verificará la privacidad)
        return redirect()->intended('home');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email');
})->name('login.post');

// --- REGISTRO ---
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
        'privacy_accepted' => false, // Aseguramos que empiece en false
    ]);

    Auth::login($user);

    // Después de registrarse, va directo a leer la privacidad
    return redirect()->route('privacidad');
})->name('register.post');

// --- FLUJO DE PRIVACIDAD (CANVA) ---
Route::get('/privacidad', function () {
    return view('auth.privacidad'); // Asegúrate de crear este archivo
})->name('privacidad')->middleware('auth');

Route::post('/privacidad-aceptar', function () {
    $user = Auth::user();
    $user->privacy_accepted = true;
    $user->save();

    return redirect()->route('home');
})->name('privacidad.aceptar')->middleware('auth');

// --- HOME (PROTEGIDO) ---
Route::get('/home', function () {
    // Verificamos si ya aceptó la privacidad
    if (!Auth::user()->privacy_accepted) {
        return redirect()->route('privacidad');
    }

    return "<h1>¡Bienvenido a EcoGuide, " . Auth::user()->name . "! Estás dentro.</h1>
            <p>Gracias por aceptar nuestras políticas de privacidad.</p>
            <form action='" . route('logout') . "' method='POST'>" . csrf_field() . "
                <button type='submit'>Cerrar Sesión</button>
            </form>";
})->name('home')->middleware('auth');

// --- LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// --- RECUPERACIÓN DE CONTRASEÑA ---
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- GOOGLE LOGIN ---
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);