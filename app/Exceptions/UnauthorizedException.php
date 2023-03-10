<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? "Não autorizado", Response::HTTP_UNAUTHORIZED);
    }
}
