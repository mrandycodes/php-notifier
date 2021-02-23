<?php

declare(strict_types=1);

namespace App\Context\Notification\UI\Controller;

use App\Context\SharedKernel\UI\Controller\ApiController;
use App\Context\Notification\Application\Send\SendNotificationCommand;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use App\Context\SharedKernel\Infrastructure\Http\Response;
use App\Context\SharedKernel\Domain\Controller\ApiHttpOkResponse;
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
