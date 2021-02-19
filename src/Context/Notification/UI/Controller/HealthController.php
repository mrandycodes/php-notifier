<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\SharedKernel\Application\Service\Http\Request;
use App\Context\SharedKernel\Application\Service\Http\Response;
use App\Context\SharedKernel\Application\Service\Http\ApiHttpOkResponse;

final class HealthController
{
    public function __invoke(Request $request): Response
    {
        return ApiHttpOkResponse::create();
    }
}
