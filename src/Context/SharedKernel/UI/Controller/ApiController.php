<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\UI\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;

abstract class ApiController
{
    abstract public function __invoke(Request $request): Response;
}
