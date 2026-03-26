<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// --- RUTAS DE LOGIN ---

// 1. Mostrar la página de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 2. Procesar el inicio de sesión
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('email');
})->name('login.post');


// --- RUTAS DE REGISTRO ---

// 3. Mostrar la página de registro
Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

// 4. Procesar el registro (Guardar usuario)
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

    return redirect()->route('dashboard');
})->name('register.post');


// --- RUTAS PROTEGIDAS ---

// 5. Dashboard (Solo entras si estás logueado)
Route::get('/dashboard', function () {
    return "<h1>¡Bienvenido a EcoGuide, " . Auth::user()->name . "! Estás dentro.</h1>
            <form action='" . route('logout') . "' method='POST'>" . csrf_field() . "
                <button type='submit'>Cerrar Sesión</button>
            </form>";
})->name('dashboard')->middleware('auth');

// 6. Cerrar sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');