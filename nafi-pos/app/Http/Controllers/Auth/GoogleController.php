<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

            // Buscamos si el usuario ya existe o lo creamos
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
            ]);

            // Iniciamos sesión con ese usuario
            Auth::login($user);

            // Redirigimos al dashboard principal de Sofiyadeluna
            return redirect('/dashboard'); 
            
        } catch (\Exception $e) {
            // Si el usuario cancela o hay un error, lo devolvemos al login
            return redirect('/login')->withErrors(['email' => 'Hubo un problema al iniciar sesión con Google.']);
        }
    }
}