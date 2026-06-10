<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
        if (!$request->user()->hasVerifiedEmail()) {

            Auth::logout();

            return back()->withErrors([
                'email' => __('auth.verify_email_error')
            ]);
        }
        $request->session()->regenerate();
        return redirect()->intended('home');
    }

    return back()->withErrors([
        'email' => __('auth.failed'),
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
        'email.unique' => __('validation.unique_email'),
        'password.min' => __('validation.password_min'),
        'email.email' => __('validation.valid_email'),
        'privacy_accepted.accepted' => __('validation.privacy_accepted'),
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'privacy_accepted' => true,
    ]);

    Auth::login($user);
    $user->sendEmailVerificationNotification();

    return redirect()->route('verification.notice');
})->name('register.post');

/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect()->route('home');

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with(
        'status',
        'verification-link-sent'
    );

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');

Route::get('/tips/create', [TipController::class, 'create'])
    ->middleware('verified')
    ->name('tips.create');

Route::post('/tips', [TipController::class, 'store'])
    ->middleware('verified')
    ->name('tips.store');

Route::middleware('auth')->group(function () {

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
| LANGUAGE
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();
})->name('lang.change');

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