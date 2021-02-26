<?php

declare(strict_types=1);

namespace Apps\Notifier\Backend\UI\Controller;

use App\Notifier\Shared\UI\Controller\ApiController;
use App\Notifier\Notification\Application\Send\SendNotificationCommand;
use App\Notifier\Shared\Infrastructure\Http\Request;
use App\Notifier\Shared\Infrastructure\Http\Response;
use App\Notifier\Shared\Infrastructure\Http\ApiHttpOkResponse;
use League\Tactician\CommandBus;

final class SendNotificationController extends ApiController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->commandBus->handle(
            new SendNotificationCommand(
                $data['type'],
                $data['message'],
                $data['arguments']
            )
        );

        return new ApiHttpOkResponse();
    }
}
