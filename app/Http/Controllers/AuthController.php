<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(AuthRequest $request):Response
    {
        $token = $this->authService->generateToken($request);

        return response()->json([
            'token' => $token,
            'type' => 'Bearer'
        ]);
    }
}
