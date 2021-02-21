<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Domain\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Response;

final class ApiHttpBadRequestResponse extends Response
{
    public function __construct($data)
    {
        parent::__construct($data, 400);
    }
}
