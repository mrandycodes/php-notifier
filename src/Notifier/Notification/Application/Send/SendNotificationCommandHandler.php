<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Application\Send;

use App\Shared\Application\Command;
use App\Shared\Application\CommandHandler;

final class SendNotificationCommandHandler extends CommandHandler
{
    private SendNotificationUseCase $useCase;

    public function __construct(SendNotificationUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(Command $command): void
    {
        /** @var SendNotificationCommand $command */
        $this->useCase->__invoke(
            NotificationParamHolder::create(
                $command->type(),
                $command->message(),
                $command->arguments()
            )
        );
    }
}
