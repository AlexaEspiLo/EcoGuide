<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    /**
     * Paso 1: Redirigir al usuario a la página de login de Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Paso 2: Recibir los datos de Google.
     */
    public function handleGoogleCallback()
    {
        try {
            // Obtenemos los datos del usuario desde Google
            $googleUser = Socialite::driver('google')->user();

            // Buscamos si el usuario ya existe por su email
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Si NO existe, lo registramos como usuario nuevo
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)), // Contraseña aleatoria por seguridad
                ]);
            } else {
                // Si ya existe pero no tiene vinculado el google_id, lo actualizamos
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            }

            // Iniciamos la sesión del usuario
            Auth::login($user);

            // Lo mandamos a la página principal (ajústala si tu ruta es diferente)
            return redirect('/home'); 

        } catch (Exception $e) {
            // Si algo sale mal, regresamos al login con un error
            return redirect('/login')->withErrors(['msg' => 'Hubo un problema al conectar con Google.']);
        }
    }
}