<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends Exception
{
    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? "Recurso não encontrado", Response::HTTP_NOT_FOUND);
    }
}
