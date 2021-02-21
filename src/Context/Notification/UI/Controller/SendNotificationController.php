<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\SharedKernel\UI\Controller\ApiController;
use App\Context\Notification\Application\Send\NotificationParamHolder;
use App\Context\Notification\Application\Send\SendNotificationUseCase;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;
use App\Context\SharedKernel\Domain\Controller\ApiHttpOkResponse;

final class SendNotificationController extends ApiController
{
    private SendNotificationUseCase $sendNotificationUseCase;

    public function __construct(SendNotificationUseCase $sendNotificationUseCase)
    {
        $this->sendNotificationUseCase = $sendNotificationUseCase;
    }

    public function __invoke(Request $request): Response
    {
        $this->sendNotificationUseCase->__invoke(
            $this->buildNotificationParamHolder($request)
        );

        return new ApiHttpOkResponse();
    }

    private function buildNotificationParamHolder(Request $request): NotificationParamHolder
    {
        $data = json_decode($request->content(), true, 512, JSON_THROW_ON_ERROR);
        return NotificationParamHolder::create(
            $data['type'],
            $data['message'],
            $data['arguments']
        );
    }
}
