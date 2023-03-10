<?php

namespace App\Providers;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use SebastianBergmann\ObjectReflector\Exception;
use UnexpectedValueException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerJWTAuth();
    }

    private function registerJWTAuth()
    {
        Auth::viaRequest('jwt', function (Request $request) {
            try {
                $tokenPayload = JWT::decode($request->bearerToken() ?? '', new Key(config('jwt.key'), 'HS256'));

                return User::findOneById($tokenPayload->id);
            } catch (UnexpectedValueException $e) {
                Log::error($e);

                throw new UnauthorizedException("Não foi possivel validar o acesso");
            }
        });
    }
}
