<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirige al usuario a la página de autenticación de Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtiene la información del usuario desde Google.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Buscamos por email para evitar conflictos y vinculamos el google_id
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'email_verified_at' => now(),
                    // Si tu tabla requiere contraseña por defecto, puedes usar:
                    'password' => bcrypt(Str::random(16)),
                ]
            );

            // Iniciamos sesión con ese usuario
            Auth::login($user);

            // Redirigimos al dashboard principal
            return redirect('/dashboard');

        } catch (\Exception $e) {
            // Si algo falla, puedes descomentar la siguiente línea para ver el error real en desarrollo:
            // dd($e);

            return redirect('/login')->withErrors(['email' => 'Hubo un problema al iniciar sesión con Google.']);
        }
    }
}
