<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Application\Send;

final class NotificationParamHolder
{
    private string $type;
    private string $message;
    private array $arguments;

    private function __construct(string $type, string $message, array $arguments)
    {
        $this->type = $type;
        $this->message = $message;
        $this->arguments = $arguments;
    }

    public static function create(string $type, string $message, array $arguments): self
    {
        return new self($type, $message, $arguments);
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
