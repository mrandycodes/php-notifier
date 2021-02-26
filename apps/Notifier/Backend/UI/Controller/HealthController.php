<?php

declare(strict_types=1);

namespace Apps\Notifier\Backend\UI\Controller;

use App\Shared\UI\Controller\ApiController;
use App\Shared\Infrastructure\Http\Request;
use App\Shared\Infrastructure\Http\Response;
use App\Shared\Infrastructure\Http\ApiHttpOkResponse;

final class HealthController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        return new ApiHttpOkResponse();
    }
}
