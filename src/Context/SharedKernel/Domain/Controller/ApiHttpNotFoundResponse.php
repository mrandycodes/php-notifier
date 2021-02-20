<?php

namespace App\Context\SharedKernel\Domain\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Response;

final class ApiHttpNotFoundResponse extends Response
{
    public function __construct($data)
    {
        parent::__construct($data, 404);
    }
}
