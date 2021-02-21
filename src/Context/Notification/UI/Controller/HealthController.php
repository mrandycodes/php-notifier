<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\SharedKernel\UI\Controller\ApiController;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;
use App\Context\SharedKernel\Domain\Controller\ApiHttpOkResponse;

final class HealthController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        return new ApiHttpOkResponse();
    }
}
