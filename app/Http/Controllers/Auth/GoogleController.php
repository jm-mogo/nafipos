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

            // Buscamos por email para evitar conflictos y vinculamos el google_id
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    // Si tu tabla requiere contraseña por defecto, puedes usar:
                    // 'password' => bcrypt(str_random(16))
                ]
            );

            // Si el usuario ya existía por email pero no tenía el google_id guardado, lo actualizamos
            if (empty($user->google_id)) {
                $user->update(['google_id' => $googleUser->id]);
            }

            // Iniciamos sesión con ese usuario
            Auth::login($user);

            // Redirigimos al dashboard principal
            return redirect('/dashboard'); 
            
        } catch (\Exception $e) {
            // Si algo falla, puedes descomentar la siguiente línea para ver el error real en desarrollo:
            // dd($e->getMessage());

            return redirect('/login')->withErrors(['email' => 'Hubo un problema al iniciar sesión con Google.']);
        }
    }
}