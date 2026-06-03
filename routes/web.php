<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use App\Models\Page;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| PASSWORD RECOVERY
|--------------------------------------------------------------------------
*/

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

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
        'email' => 'The credentials do not match.',
    ]);

})->name('login.post');

/*
|--------------------------------------------------------------------------
| REGISTRATION
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => [
            'required',
            'confirmed',

            Password::min(12)
        ],
        'privacy_accepted' => 'accepted',
    ], [
        'email.unique' => 'This email address is already registered.',
        'password.min' => 'The password must be at least 12 characters long.',
        'email.email' => 'Enter a valid email address.',
        'privacy_accepted.accepted' => 'You must accept the Privacy Police.',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'privacy_accepted' => true,
    ]);

    Auth::login($user);

    return redirect()->route('home');
})->name('register.post');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/tips/load', [HomeController::class, 'loadMore']);

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');

Route::get('/tip/{id}', [TipController::class, 'show'])
    ->name('tip.show');

Route::get('/tips/filter', [HomeController::class, 'filter'])
    ->name('tips.filter');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');

Route::get('/page/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('user.info', compact('page'));
})->name('page.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::post('/like', [TipController::class, 'like']);

    /*
    | Profile
    */

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('perfil');

    Route::get('/account', [ProfileController::class, 'account'])
        ->name('account');

    Route::patch('/account/update', [ProfileController::class, 'updateAccount'])
        ->name('account.update');

    Route::post('/account/avatar', [ProfileController::class, 'updateAvatar'])
        ->name('account.avatar');

    /*
    | Tips
    */

    Route::get('/tip/{id}/edit', [TipController::class, 'edit'])
        ->name('tip.edit');

    Route::get('/tips/create', [TipController::class, 'create'])
        ->name('tips.create');

    Route::post('/tips', [TipController::class, 'store'])
        ->name('tips.store');

    Route::get('/tips/{id}/edit', [TipController::class, 'edit'])
        ->name('tips.edit');

    Route::patch('/tips/{id}', [TipController::class, 'update'])
        ->name('tips.update');

    Route::delete('/tips/{id}', [TipController::class, 'destroy'])
        ->name('tips.destroy');

    /*
    | Logout
    */

    Route::post('/logout', function (Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');

    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/account', function () {
            return view('admin.account');
        })->name('account-admin');

        Route::get('/tips', [TipController::class, 'index'])
            ->name('tips');

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users');

        Route::get('/pages', [PageController::class, 'index'])
            ->name('pages');

        Route::get('/pages/{slug}', [PageController::class, 'edit'])
            ->name('pages.edit');

        Route::put('/pages/{id}', [PageController::class, 'update'])
            ->name('pages.update');

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::patch('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');
    });

/*
|--------------------------------------------------------------------------
| GOOGLE AUTH
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| TESTING
|--------------------------------------------------------------------------
*/

Route::get('/test-404', function () {
    return view('errors.404');
});