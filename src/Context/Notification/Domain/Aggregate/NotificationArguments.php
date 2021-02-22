<?php

declare(strict_types=1);

namespace App\Context\Notification\Domain\Aggregate;

final class NotificationArguments
{
    private array $arguments;

    private function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public static function create(array $arguments): self
    {
        return new self($arguments);
    }

    public function value(): array
    {
        return $this->arguments;
    }
}
