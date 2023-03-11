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

    /**
     * @OA\Post(
     *      path="/auth",
     *      summary="Autenticar e gerar token",
     *      tags={"Autenticação"},
     *      description="Retorna token de autenticação",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="email", type="string", example="teste@teste.com"),
     *              @OA\Property(property="password", type="string", example="12345#qwert")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Token gerado com sucesso",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string", example="{{token}}"),
     *              @OA\Property(property="type", type="string", example="Bearer")
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Ao falhar em uma validação",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="email", type="array", items=@OA\Items()),
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Não foi possivel validar o acesso",
     *
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="E-mail e/ou senha inválidos")
     *          )
     *      )
     * )
     */
    public function auth(AuthRequest $request):Response
    {
        $token = $this->authService->generateToken($request);

        return response()->json([
            'token' => $token,
            'type' => 'Bearer'
        ]);
    }
}
