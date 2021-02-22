<?php

declare(strict_types=1);

namespace App\Context\Notification\Application\Send;

use App\Context\SharedKernel\Application\Command;
use App\Context\SharedKernel\Application\CommandHandler;

final class SendNotificationCommandHandler extends CommandHandler
{
    public function __invoke(Command $command): void
    {
    }
}
