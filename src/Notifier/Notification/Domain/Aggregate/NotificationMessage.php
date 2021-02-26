<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Shared\Domain\ValueObjects\StringValueObject;

final class NotificationMessage extends StringValueObject
{
    private function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function create(string $value): self
    {
        return new self($value);
    }
}
