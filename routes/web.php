<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

Route::get('/home', function () {
    return "<h1>¡Bienvenido a EcoGuide, " . Auth::user()->name . "! Estás dentro.</h1>
            <form action='" . route('logout') . "' method='POST'>" . csrf_field() . "
                <button type='submit'>Cerrar Sesión</button>
            </form>";
})->name('home')->middleware('auth');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');