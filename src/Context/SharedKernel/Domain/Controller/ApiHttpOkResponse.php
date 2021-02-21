<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Domain\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Response;

final class ApiHttpOkResponse extends Response
{
    public function __construct()
    {
        parent::__construct([], 200);
    }
}
