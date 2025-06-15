<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite; // Pastikan penulisan benar
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        // Validasi provider yang didukung
        $supportedProviders = ['github', 'google', 'microsoft'];
        
        if (!in_array($provider, $supportedProviders)) { // Perbaikan penulisan in_array
            return redirect()->route('login')->withErrors( // Perbaikan penulisan route
                'Provider login tidak didukung'
            );
        }

        return Socialite::driver($provider)->redirect(); // Perbaikan penulisan Socialite
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    $provider.'_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'password' => bcrypt(Str::random(16))
                ]
            );

            Auth::login($user);

            return redirect()->route('dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(
                'Gagal login menggunakan '.ucfirst($provider).': '.$e->getMessage()
            );
        }
    }
}