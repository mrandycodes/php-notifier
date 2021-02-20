<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;
use App\Context\SharedKernel\Domain\Controller\ApiHttpOkResponse;

final class HealthController
{
    public function __invoke(Request $request): Response
    {
        return new ApiHttpOkResponse();
    }
}
