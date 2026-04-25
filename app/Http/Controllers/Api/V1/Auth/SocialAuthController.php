<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(24)),
                    'email_verified_at' => now(),
                ]);
            }

            $token = $user->createToken('SocialAuth')->accessToken;

            return $this->successResponse([
                'user' => $user,
                'token' => $token,
            ], 'Authenticated successfully');

        } catch (\Exception $e) {
            return $this->errorResponse('Authentication failed: ' . $e->getMessage(), 401);
        }
    }
}
