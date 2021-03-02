<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Aggregate;

final class NotificationArguments
{
    private array $value;

    private function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function create(array $value): self
    {
        return new self($value);
    }

    public function value(): array
    {
        return $this->value;
    }

    public function equals($other)
    {
        return get_class($this) === get_class($other) && $this->value === $other->value;
    }
}
