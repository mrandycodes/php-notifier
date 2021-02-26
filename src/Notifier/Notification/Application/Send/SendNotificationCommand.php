<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Application\Send;

use App\Shared\Application\Command;

final class SendNotificationCommand extends Command
{
    private string $type;
    private string $message;
    private array $arguments;

    public function __construct(
        string $type,
        string $message,
        array $arguments
    ) {
        $this->type = $type;
        $this->message = $message;
        $this->arguments = $arguments;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function arguments(): array
    {
        return $this->arguments;
    }
}
