<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\UI\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;
use League\Tactician\CommandBus;

abstract class ApiController
{
    abstract public function __construct(CommandBus $commandBus);

    abstract public function __invoke(Request $request): Response;
}
