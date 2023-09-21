<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($credentials): array
    {
        $token = Auth::attempt($credentials);

        throw_if(!$token, LoginException::class);

        return [
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'user'          => Auth::user(),
            'expires_in'    => Auth::factory()->getTTL() * 60
        ];
    }
}
