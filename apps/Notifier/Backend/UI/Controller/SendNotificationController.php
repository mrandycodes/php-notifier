<?php

declare(strict_types=1);

namespace Apps\Notifier\Backend\UI\Controller;

use App\Shared\UI\Controller\ApiController;
use App\Notifier\Notification\Application\Send\SendNotificationCommand;
use App\Shared\Infrastructure\Http\ApiHttpBadRequestResponse;
use App\Shared\Infrastructure\Http\Request;
use App\Shared\Infrastructure\Http\Response;
use App\Shared\Infrastructure\Http\ApiHttpOkResponse;
use InvalidArgumentException;
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

        try {
            $this->commandBus->handle(
                new SendNotificationCommand(
                    $data['type'],
                    $data['message'],
                    $data['arguments']
                )
            );
        } catch (InvalidArgumentException $exception) {
            return new ApiHttpBadRequestResponse($exception->getMessage());
        }

        return new ApiHttpOkResponse();
    }
}
