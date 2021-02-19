<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\Notification\Application\Send\NotificationParamHolder;
use App\Context\SharedKernel\Application\Service\Http\ApiHttpOkResponse;
use App\Context\SharedKernel\Application\Service\Http\Request;
use App\Context\SharedKernel\Application\Service\Http\Response;

final class SendNotificationController
{
    public function __invoke(Request $request): Response
    {
        // TODO
        // $this->sendNotificationUseCase->__invoke(
        //     $this->buildNotificationParamHolder($request)
        // );

        return ApiHttpOkResponse::create();
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
