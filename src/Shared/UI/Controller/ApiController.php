<?php

declare(strict_types=1);

namespace App\Shared\UI\Controller;

use App\Shared\Infrastructure\Http\Request;
use App\Shared\Infrastructure\Http\Response;

abstract class ApiController
{
    abstract public function __invoke(Request $request): Response;
}
