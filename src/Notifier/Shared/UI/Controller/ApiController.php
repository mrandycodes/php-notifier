<?php

declare(strict_types=1);

namespace App\Notifier\Shared\UI\Controller;

use App\Notifier\Shared\Infrastructure\Http\Request;
use App\Notifier\Shared\Infrastructure\Http\Response;

abstract class ApiController
{
    abstract public function __invoke(Request $request): Response;
}
