<?php

namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @throws UnauthorizedException
     */
    public function generateToken(AuthRequest $request): string
    {
        $user = User::findOneByEmail($request->get('email'));

        if (empty($user) || !Hash::check($request->get('password'), $user->password))
            throw new UnauthorizedException("E-mail e/ou senha inválidos");

        return JWT::encode(['id' => $user->id], config('jwt.key'), 'HS256');
    }
}
