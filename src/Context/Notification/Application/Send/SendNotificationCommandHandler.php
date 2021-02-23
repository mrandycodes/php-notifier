<?php

declare(strict_types=1);

namespace App\Context\Notification\Application\Send;

use App\Context\SharedKernel\Application\Command;
use App\Context\SharedKernel\Application\CommandHandler;

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
