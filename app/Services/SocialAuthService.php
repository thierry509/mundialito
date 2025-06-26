<?php

namespace App\Services;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialAuthService
{
    public function findOrCreateUser(SocialUser $socialUser, string $provider): User
    {
        $user = User::where('email', $socialUser->getEmail())->first();
        if ($user) {
            if ($user->provider === $provider) {
                // Mise à jour des infos du provider si l'utilisateur existe déjà
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                ]);
            }else{
                throw new \Exception('L\'email est déjà utilisé par un autre compte.');
            }
        } else {
            // Création d'un nouvel utilisateur
            $user = User::create([
                'first_name' => $socialUser->getName(),
                'last_name' => $socialUser->user->family_name ?? null,
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'email_verified_at' => now(),
            ]);
                event(new Verified($user));
        }

        return $user;
    }
}
